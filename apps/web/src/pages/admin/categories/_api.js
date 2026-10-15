import { api } from "@/boot/axios"

export const getCategories = (params = {}) => {
  return api.get('/categories', { params }).then(({ data }) => data)
}

export const createCategory = (params = {}) => {
  return api.post('/categories', params).then(({ data }) => data)
}

export const updateCategory = (id, params = {}) => {
  return api.put(`/categories/${id}`, params).then(({ data }) => data)
}

export const deleteCategory = (id) => {
  return api.delete(`/categories/${id}`).then(({ data }) => data)
}