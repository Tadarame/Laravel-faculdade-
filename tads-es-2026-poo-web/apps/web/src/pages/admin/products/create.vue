<template>
  <q-page padding>
    <q-card>
      <q-card-actions>
        <q-btn flat no-caps icon="arrow_back" to="/admin/products" label="Cadastrar produto" />
      </q-card-actions>
      <q-card-section>
        <product-form v-model="product" @submit="saveProduct" />
      </q-card-section>
    </q-card>
  </q-page>
</template>

<script setup>
import ProductForm from '@/components/ProductForm.vue'
import { ref } from 'vue'
import { createProduct } from './_api'
import { Notify } from 'quasar'
import { useRouter } from 'vue-router'

const router = useRouter()

const product = ref({
  enabled: true,
  name: '',
  description: '',
  image: null,
  price: 0,
  stock: 0,
  saving: false,
})

const saveProduct = () => {
  product.value.saving = true
  createProduct(product.value)
    .then((data) => {
      Notify.create('Produto cadastrado!')
      router.push(`/admin/products/${data.id}`)
    })
    .catch((e) => {
      console.log(e?.response)
      Notify.create({
        type: 'negative',
        message: 'Falha na operação',
        caption: e?.response?.data?.message ?? 'Analisar logs',
      })
    })
    .finally(() => {
      product.value.saving = false
    })
}
</script>
