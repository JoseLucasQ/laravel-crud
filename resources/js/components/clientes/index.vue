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
    console.log('clientes tamanho', clientes.lenght)
    console.log(clientes.value[0])
    console.log(clientes.value.length)
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
                  <h1 class="my-1">Lista de Clientes</h1>
              </div>
              <div class="customers__titlebar--item">
                  <button class="btn btn-secondary my-1" @click="newCliente">
                      Adicionar Cliente
                  </button>
              </div>
          </div>
  
          <div class="table--heading mt-2 products__list__heading " style="padding-top: 20px;background:#FFF">
              <!-- <p class="table--heading--col1">&#32;</p> -->
              <p class="table--heading--col1">Foto</p>
              <p class="table--heading--col2">
                  RG
              </p>
              <p class="table--heading--col2">email</p>
              <p class="table--heading--col3">
                  Telefone
              </p>
              <p class="table--heading--col3">
                  Endereço
              </p>
              <!-- <p class="table--heading--col5">&#32;</p> -->
              <p class="table--heading--col2">actions</p>
          </div>
  
          <!-- product 1 -->
          <div class="table--items products__list__item" v-for="pessoa in clientes" :key="pessoa.id">
              <div class="products__list__item--imgWrapper">
                 <!-- <img class="products__list__item--img" :src="ourImage(pessoa.photo)"  style="height: 40px;" v-if="pessoa.photo">-->
              </div>
              <a href="# " class="table--items--col2">
                  {{ pessoa.nome }}
              </a>
              <p class="table--items--col2">
                  {{ pessoa.rg }}
              </p>
              <p class="table--items--col3">
                {{ pessoa.email }}
              </p>     
              <p class="table--items--col3">
                {{ pessoa.telefone }}
              </p>   
              <p class="table--items--col3">
                {{ pessoa.endereço }}
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
      </div>
    </div>
</template>