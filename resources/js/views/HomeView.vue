<template>
  <div class="home">
    <div class="container">
      <div class="row d-flex justify-content-between mt-5">
        <div class="col-md-4">
          <div class="card mb-3">
            <div class="card-body">
              <div class="mb-3">
                <label for="name">Name</label>
                <input type="text" id="name" class="form-control" />
              </div>

              <div class="mb-3">
                <label for="price">Price</label>
                <input type="text" id="price" class="form-control" />
              </div>

              <div class="d-flex justify-content-end">
                <div v-if="isEdit">
                  <button class="btn btn-sm btn-warning">
                    <small class="fas fa-edit me-1"></small>Edit
                  </button>
                </div>
                <div v-else>
                  <button class="btn btn-sm btn-primary">
                    <small class="fas fa-plus-circle me-1"></small>Create
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-8">
          <div>
            <div class="card">
              <div class="card-header bg-white">
                <button class="btn btn-primary" @click="createBtn">
                  <i class="fas fa-plus-circle me-2"></i>Create
                </button>
              </div>
              <div class="card-body shadow-sm">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Name</th>
                      <th scope="col">Price</th>
                      <th scope="col" class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">1</th>
                      <td>Mark</td>
                      <td>Otto</td>
                      <td class="text-center">
                        <button class="btn btn-sm btn-danger mx-1">
                          <i class="fas fa-trash-alt"></i>
                        </button>
                        <button
                          class="btn btn-sm btn-warning mx-1"
                          @click="editBtn"
                        >
                          <i class="fas fa-edit"></i>
                        </button>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row">2</th>
                      <td>Jacob</td>
                      <td>Thornton</td>
                      <td class="text-center">
                        <button class="btn btn-sm btn-danger mx-1">
                          <i class="fas fa-trash-alt"></i>
                        </button>
                        <button
                          class="btn btn-sm btn-warning mx-1"
                          @click="editBtn"
                        >
                          <i class="fas fa-edit"></i>
                        </button>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row">3</th>
                      <td colspan="2">Larry the Bird</td>
                      <td class="text-center">
                        <button class="btn btn-sm btn-danger mx-1">
                          <i class="fas fa-trash-alt"></i>
                        </button>
                        <button
                          class="btn btn-sm btn-warning mx-1"
                          @click="editBtn"
                        >
                          <i class="fas fa-edit"></i>
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref } from "@vue/reactivity";
export default {
  setup() {
    let isEdit = ref(false);

    let editBtn = () => {
      isEdit.value = true;
    };

    let createBtn = () => {
      isEdit.value = false;
    };

    return { isEdit, editBtn, createBtn };
  },
};
</script>

<style>
</style>
