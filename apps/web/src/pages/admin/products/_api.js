import { api } from "@/boot/axios"

export const getProducts = (params = {}) => {
  return api.get('/products', { params }).then(({ data }) => data)
}

export const createProduct = (params = {}) => {
  return api.post('/products', params).then(({ data }) => data)
}

export const getProduct = (id) => {
  return api.get(`/products/${id}`).then(({ data }) => data)
}

export const updateProduct = (id, params = {}) => {
  return api.put(`/products/${id}`, params).then(({ data }) => data)
}

export const deleteProduct = (id) => {
  return api.delete(`/products/${id}`).then(({ data }) => data)
}