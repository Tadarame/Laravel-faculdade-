<template>
  <q-uploader
    flat
    bordered
    auto-upload
    no-thumbnails
    :max-files="1"
    :max-file-size="30 * 1024 * 1024"
    v-bind="formConfig"
    @uploaded="onUpload"
    @failed="onFailed"
    @rejected="onRejected"
    ref="uploader"
    class="full-width"
  />
</template>

<script setup>
import { LocalStorage, Notify } from 'quasar'
import { computed, ref } from 'vue'

const uploader = ref(null)
const emit = defineEmits(['upload'])

const formConfig = computed(() => {
  const auth = LocalStorage.getItem('auth_data') ?? {}
  const token = auth?.token

  return {
    url: `${import.meta.env.QCLI_API_URL.replace(/\/$/, '')}/upload`,
    fieldName: 'file',
    headers: token ? [{ name: 'Authorization', value: `Bearer ${token}` }] : [],
  }
})

const onUpload = ({ xhr }) => {
  try {
    emit('upload', JSON.parse(xhr.responseText))
    uploader.value?.removeUploadedFiles()
  } catch {
    Notify.create({
      type: 'negative',
      message: 'Não foi possível processar a resposta do upload.',
    })
  }
}

const onFailed = ({ xhr }) => {
  let message = 'Falha ao enviar a imagem.'

  try {
    message = JSON.parse(xhr.responseText)?.message ?? message
  } catch {
    // Keep the generic message when the server response is not JSON.
  }

  Notify.create({ type: 'negative', message })
}

const onRejected = () => {
  Notify.create({
    type: 'negative',
    message: 'Escolha apenas uma imagem de até 30 MB.',
  })
}
</script>

<style scoped>
:deep(.q-uploader__list) {
  display: none;
}
</style>
