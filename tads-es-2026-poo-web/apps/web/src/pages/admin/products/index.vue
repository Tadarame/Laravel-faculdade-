<template>
  <q-page padding>
    <q-list separator>
      <q-item class="row">
        <q-item-section avatar>
          <q-avatar icon="inventory_2" />
        </q-item-section>
        <q-item-section>
          <q-input
            stack-label
            v-model="search"
            :label="`Produtos (${paging?.total ?? '..'})`"
            placeholder="Pesquisar"
          />
        </q-item-section>
        <q-item-section side>
          <q-btn round flat color="secondary" icon="add" to="/admin/products/create" />
        </q-item-section>
      </q-item>
      <q-item v-for="product in paging.data" :key="product.id">
        <q-item-section v-if="product.image" avatar>
          <q-img :src="product.image" width="64px" height="64px" fit="contain" />
        </q-item-section>
        <q-item-section>
          <q-item-label>
            {{ product.name }}
          </q-item-label>
          <q-item-label caption>
            {{ product.description }}
          </q-item-label>
        </q-item-section>
        <q-item-section side>
          <q-btn-group rounded flat>
            <q-btn flat color="primary" icon="edit" :to="`/admin/products/${product.id}`" />
            <q-btn flat color="negative" icon="delete" @click="confirmToDelete(product)" />
          </q-btn-group>
        </q-item-section>
      </q-item>
      <q-item>
        <q-item-section class="flex flex-center">
          <q-pagination
            v-model="paging.current_page"
            :max="paging.last_page"
            @update:model-value="fetchProducts"
          />
        </q-item-section>
      </q-item>
    </q-list>
  </q-page>
</template>

<script setup>
import { onMounted, ref } from 'vue'
import { deleteProduct, getProducts } from './_api'
import { Dialog, Notify } from 'quasar'

const search = ref('')
const paging = ref({
  current_page: 1,
  last_page: 1,
})

// Lista (paginada/index) produtos
const fetchProducts = () => {
  getProducts({
    page: paging.value.current_page,
  }).then((data) => {
    paging.value = data
  })
}

// Confirma e executa exclusão do registro
const confirmToDelete = (_product) => {
  Dialog.create({
    message: 'Confirma exclusão do produto?',
    caption: 'Esta ação não pode ser desfeita',
  }).onOk(() => {
    deleteProduct(_product.id)
      .then(() => {
        Notify.create('Produto excluído!')
        fetchProducts()
      })
      .catch((e) => {
        console.log(e?.response)
        Notify.create({
          type: 'negative',
          message: 'Falha na operação',
          caption: e?.response?.data?.message ?? 'Analisar logs',
        })
      })
  })
}

onMounted(() => {
  fetchProducts()
})
</script>
