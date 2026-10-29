<template>
  <q-form class="q-gutter-y-md" @submit.prevent="emit('submit')">
    <q-toggle
      v-model="product.enabled"
      :label="`Produto ${product.enabled ? 'ativo' : 'inativo'}`"
    />
    <q-input outlined stack-label required label="Nome" v-model="product.name" />
    <q-input
      outlined
      stack-label
      required
      autogrow
      label="Descrição"
      v-model="product.description"
    />
    <input-money outlined stack-label required label="Preço" v-model="product.price" />
    <q-input outlined stack-label required label="Estoque" v-model="product.stock" />
    <file-uploader
      label="Imagem do produto"
      accept="image/*"
      @upload="product.image = $event.url"
    />
    <div class="text-center">
      <q-img v-if="product.image" :src="product.image" width="25vw" />
    </div>
    <div class="full-width bg-grey-1 q-py-md">
      <q-btn-group spread flat>
        <q-btn
          flat
          no-caps
          :loading="product.saving"
          type="submit"
          label="Salvar"
          icon="save"
          color="positive"
        />
      </q-btn-group>
    </div>
  </q-form>
</template>

<script setup>
import FileUploader from './FileUploader.vue'
import InputMoney from './InputMoney.vue'

const product = defineModel()
const emit = defineEmits(['submit'])
</script>
