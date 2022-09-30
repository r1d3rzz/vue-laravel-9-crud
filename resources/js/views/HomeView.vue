<template>
  <div class="home">
    <div class="container">
      <div class="row d-flex justify-content-between mt-5">
        <div class="col-md-4">
          <div class="card mb-3">
            <div class="card-body">
              <form @submit.prevent="isEdit ? editItem() : createItem()">
                <div class="mb-3">
                  <label for="name">Name</label>
                  <input
                    type="text"
                    id="name"
                    class="form-control"
                    v-model="name"
                  />
                </div>

                <div class="mb-3">
                  <label for="price">Price</label>
                  <input
                    type="text"
                    id="price"
                    class="form-control"
                    v-model="price"
                  />
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
              </form>
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
                    <tr v-for="item in items" :key="item.id">
                      <th scope="row">{{ item.id }}</th>
                      <td>{{ item.name }}</td>
                      <td>${{ item.price }}.00</td>
                      <td class="text-center">
                        <button
                          class="btn btn-sm btn-danger mx-1"
                          @click="deleteItem(item.id)"
                        >
                          <i class="fas fa-trash-alt"></i>
                        </button>
                        <button
                          class="btn btn-sm btn-warning mx-1"
                          @click="editBtn(item.id)"
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
import axios from "axios";
import { onMounted } from "@vue/runtime-core";
import Swal from "sweetalert2";

export default {
  setup() {
    let isEdit = ref(false);
    let name = ref("");
    let price = ref("");
    let itemId = ref("");

    const Toast = Swal.mixin({
      toast: true,
      position: "top-end",
      showConfirmButton: false,
      timer: 1500,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.addEventListener("mouseenter", Swal.stopTimer);
        toast.addEventListener("mouseleave", Swal.resumeTimer);
      },
    });

    let editBtn = async (id) => {
      await axios.get("/api/items/" + id).then((res) => {
        name.value = res.data.name;
        price.value = res.data.price;
        itemId.value = res.data.id;
      });
      isEdit.value = true;
    };

    let createBtn = () => {
      name.value = "";
      price.value = "";
      isEdit.value = false;
    };

    let items = ref([]);

    let getItems = async () => {
      await axios
        .get("/api/items")
        .then((res) => {
          items.value = res.data.items;
        })
        .catch((err) => console.log(err.message));
    };

    onMounted(() => {
      return getItems();
    });

    let createItem = async () => {
      await axios
        .post("/api/items", {
          name: name.value,
          price: price.value,
        })
        .then((_) => {
          Toast.fire({
            icon: "success",
            title: "Created successfully",
          });
          name.value = "";
          price.value = "";
          getItems();
        })
        .catch((err) => console.log(err.message));
    };

    let editItem = async () => {
      await axios
        .put("/api/items/" + itemId.value, {
          name: name.value,
          price: price.value,
          id: itemId.value,
        })
        .then((_) => {
          Toast.fire({
            icon: "success",
            title: "Edited successfully",
          });
          name.value = "";
          price.value = "";
          itemId.value = "";
          isEdit.value = false;
          getItems();
        })
        .catch((err) => console.log(err.message));
    };

    let deleteItem = async (id) => {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios.delete("/api/items/" + id).then((_) => getItems());
          Swal.fire("Deleted!", "Your file has been deleted.", "success");
        }
      });
    };

    return {
      isEdit,
      editBtn,
      createBtn,
      items,
      createItem,
      editItem,
      name,
      price,
      deleteItem,
    };
  },
};
</script>

<style>
</style>
