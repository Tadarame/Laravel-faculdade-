<template>
  <q-page padding>

    <!-- Form (Dialog) de criação/edição de categorias -->
    <q-dialog v-model="openForm">
      <q-card style="width: 700px; max-width: 80vw">
        <q-card-section class="row items-center q-pb-none">
          <div class="text-h6">
            {{ formObject?.id ? 'Editar categoria' : 'Nova categoria' }}
          </div>
          <q-space />
          <q-btn icon="close" flat round dense v-close-popup />
        </q-card-section>

        <q-card-section>
          <q-form
            v-if="formObject"
            class="q-gutter-y-md"
            @submit="doSubmit"
          >
            <q-input
              stack-label
              required
              label="Nome"
              v-model="formObject.name"
            />
            <q-input
              stack-label
              required
              autogrow
              label="Descrição"
              v-model="formObject.description"
            />
            <div class="full-width bg-grey-1 q-py-md">
              <q-btn-group spread flat>
                <q-btn
                  flat
                  no-caps
                  v-close-popup
                  label="Cancelar"
                  icon="cancel"
                  color="primary"
                />
                <q-btn
                  flat
                  no-caps
                  :loading="saving"
                  type="submit"
                  label="Salvar"
                  icon="save"
                  color="positive"
                />
              </q-btn-group>
            </div>
          </q-form>
        </q-card-section>
      </q-card>
    </q-dialog>

    <!-- Lista de categorias -->
    <q-list separator>
      <q-item class="row">
        <q-item-section avatar>
          <q-avatar icon="category" />
        </q-item-section>
        <q-item-section>
          <q-input
            stack-label
            v-model="search"
            :label="`Categorias (${paging?.total ?? '..'})`"
            placeholder="Pesquisar"
          />
        </q-item-section>
        <q-item-section side>
          <q-btn
            round
            flat
            color="secondary"
            icon="add"
            @click="manageCategory()"
          />
        </q-item-section>
      </q-item>
      <q-item
        v-for="category in paging.data"
        :key="category.id"
      >
        <q-item-section>
          <q-item-label>
            {{ category.name }}
          </q-item-label>
          <q-item-label caption>
            {{ category.description }}
          </q-item-label>
        </q-item-section>
        <q-item-section side>
          <q-btn-group rounded flat>
            <q-btn
              flat
              color="primary"
              icon="edit"
              @click="manageCategory(category)"
            />
            <q-btn
              flat
              color="negative"
              icon="delete"
              @click="confirmToDelete(category)"
            />
          </q-btn-group>
        </q-item-section>
      </q-item>
      <q-item>
        <q-item-section class="flex flex-center">
          <q-pagination
            v-model="paging.current_page"
            :max="paging.last_page"
            @update:model-value="fetchCategories"
          />
        </q-item-section>
      </q-item>
    </q-list>
  </q-page>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import { createCategory, deleteCategory, getCategories, updateCategory } from './_api';
import { Dialog, Notify } from 'quasar';

// Parâmetros de listagem
const search = ref('')
const paging = ref({
  current_page: 1,
  last_page: 1,
})

// Parâmetros de criação/edição
const saving = ref(false)
const openForm = ref(false)
const formObject = ref(null)

// Lista (paginada/index) categorias
const fetchCategories = () => {
  getCategories({
    page: paging.value.current_page,
  }).then((data) => {
    paging.value = data
  })
}

// Prevent side-effect
// Copia o objeto da lista para o objeto de edição
const manageCategory = (_category) => {
  formObject.value = {
    id: _category?.id ?? null,
    name: _category?.name ?? null,
    description: _category?.description ?? null,
  }
  openForm.value = true
}

// Envia dados para API, para criar ou atualizar o registro
const doSubmit = () => {
  saving.value = true
  if (formObject?.value?.id) {
    updateCategory(formObject.value.id, formObject.value).then(() => {
      Notify.create('Categoria atualizada!')
      fetchCategories()
      formObject.value = null
      openForm.value = false
    }).finally(() => {
      saving.value = false
    }).catch((e) => {
      console.log(e?.response)
      Notify.create({
        type: 'negative',
        message: 'Falha na operação',
        caption: e?.response?.data?.message ?? 'Analisar logs',
      })
    })
  } else {
    createCategory(formObject.value).then(() => {
      Notify.create('Categoria criada!')
      fetchCategories()
      formObject.value = null
      openForm.value = false
    }).finally(() => {
      saving.value = false
    }).catch((e) => {
      console.log(e?.response)
      Notify.create({
        type: 'negative',
        message: 'Falha na operação',
        caption: e?.response?.data?.message ?? 'Analisar logs',
      })
    })
  }
}

// Confirma e executa exclusão do registro
const confirmToDelete = (_category) => {
  Dialog.create({
    message: 'Confirma exclusão da categoria?',
    caption: 'Esta ação não pode ser desfeita',
  }).onOk(() => {
    deleteCategory(_category.id).then(() => {
      Notify.create('Categoria excluída!')
      fetchCategories()
    }).catch((e) => {
      console.log(e?.response)
      Notify.create({
        type: 'negative',
        message: 'Falha na operação',
        caption: e?.response?.data?.message ?? 'Analisar logs',
      })
    })
  })
}

// Ao inicializar, executa listagem
onMounted(() => {
  fetchCategories()
})
</script>