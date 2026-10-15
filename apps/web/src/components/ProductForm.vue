<template>
  <q-form class="q-gutter-y-md">
    <q-toggle
      v-model="product.enabled"
      :label="`Produto ${product.enabled ? 'ativo' : 'inativo'}`"
    />
    <q-input
      outlined
      stack-label
      required
      label="Nome"
      v-model="product.name"
    />
    <q-input
      outlined
      stack-label
      required
      autogrow
      label="Descrição"
      v-model="product.description"
    />
    <input-money
      outlined
      stack-label
      required
      label="Preço"
      v-model="product.price"
    />
    <q-input
      outlined
      stack-label
      required
      label="Estoque"
      v-model="product.stock"
    />
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
import InputMoney from './InputMoney.vue';

const product = defineModel({
  id: null,
  enabled: true,
  name: null,
  description: null,
  price: 0,
  stock: 0,
  saving: false,
})
</script>
