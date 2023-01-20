<script setup>
import { assertExpressionStatement } from '@babel/types';
import { onMounted, ref } from 'vue';
import { useRouter } from "vue-router"

const router = useRouter()

let clientes = ref([])

onMounted(async () => {
    getClientes()
})

const newCliente = () => {
    useRouter.push('/cliente/new')
}

const getClientes = async () => {
    let response = await axios.get("/api/get_all_clientes")
    clientes.value = response.data.clientes
    console.log('clientes', clientes.value)
}

const ourImage = (img) => {
    return "/upload/"+img
}

</script>

<template>
    <div class="container">
      
      <div class="products__list table  my-3">
                
          <div class="customers__titlebar dflex justify-content-between align-items-center">
              <div class="customers__titlebar--item">
                  <h1 class="my-1">Products</h1>
              </div>
              <div class="customers__titlebar--item">
                  <button class="btn btn-secondary my-1" @click="newCliente">
                      Add Product
                  </button>
              </div>
          </div>
  
          <div class="table--heading mt-2 products__list__heading " style="padding-top: 20px;background:#FFF">
              <!-- <p class="table--heading--col1">&#32;</p> -->
              <p class="table--heading--col1">image</p>
              <p class="table--heading--col2">
                  Product
              </p>
              <p class="table--heading--col4">Type</p>
              <p class="table--heading--col3">
                  Inventory
              </p>
              <!-- <p class="table--heading--col5">&#32;</p> -->
              <p class="table--heading--col5">actions</p>
          </div>
  
          <!-- product 1 -->
          <div class="table--items products__list__item" v-for="pessoa in clientes" :key="pessoa.id" v-if="clientes.lenght > 0">
              <div class="products__list__item--imgWrapper">
                  <img class="products__list__item--img" :src="ourImage(pessoa.photo)"  style="height: 40px;" v-if="pessoa.photo">
              </div>
              <a href="# " class="table--items--col2">
                  {{ pessoa.nome }}
              </a>
              <p class="table--items--col2">
                  type
              </p>
              <p class="table--items--col3">
                  10
              </p>     
              <div>     
                  <button class="btn-icon btn-icon-success" >
                      <i class="fas fa-pencil-alt"></i>
                  </button>
                  <button class="btn-icon btn-icon-danger" >
                      <i class="far fa-trash-alt"></i>
                  </button>
              </div>
          </div>
          <div class="table--items products__list__item" v-else>
            <p> Nenhum Cliente Encontrado</p>
          </div>
  
      </div>
    </div>
</template>