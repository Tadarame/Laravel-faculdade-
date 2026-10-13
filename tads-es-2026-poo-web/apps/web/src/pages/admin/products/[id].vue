<template>
  <q-page padding>
    <q-card v-if="product?.id">
      <q-card-actions>
        <q-btn
          flat
          no-caps
          icon="arrow_back"
          to="/admin/products"
          label="Editar produto"
        />
      </q-card-actions>
      <q-card-section>
        <product-form
          v-model="product"
          @submit="saveProduct"
        />
      </q-card-section>
    </q-card>
  </q-page>
</template>

<script setup>
import ProductForm from '@/components/ProductForm.vue';
import { onMounted, ref } from 'vue';
import { useRoute } from 'vue-router';
import { getProduct, updateProduct } from './_api';
import { Notify } from 'quasar';

const route = useRoute()

const product = ref(null)

const saveProduct = () => {
  product.value.saving = true
  updateProduct(product.value.id, product.value).then(() => {
    Notify.create('Produto atualizado!')
  }).catch((e) => {
    console.log(e?.response)
    Notify.create({
      type: 'negative',
      message: 'Falha na operação',
      caption: e?.response?.data?.message ?? 'Analisar logs',
    })
  }).finally(() => {
    product.value.saving = false
  })
}

onMounted(() => {
  getProduct(route.params.id).then((data) => {
    product.value = data
  })
})
</script>