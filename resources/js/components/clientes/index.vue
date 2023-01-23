<script setup>
import { assertExpressionStatement, shallowEqual } from '@babel/types';
import { onMounted, ref } from 'vue';
import { useRouter } from "vue-router"

const router = useRouter()

let clientes = ref([])

onMounted(async () => {
    getClientes()
})

const newCliente = () => {
    router.push('/cliente/new')
}

const getClientes = async () => {
    let response = await axios.get("/api/get_all_clientes")
    clientes.value = response.data.clientes
}

const ourImage = (img) => {
    return "/upload/"+img
}

const onEdit = (id) => {
    router.push('/cliente/edit/'+id)
}

const deleteCliente = (id) => {
    Swal.fire({
        title:'Tem certeza?',
        text:"Você não pode voltar atrás",
        icon:"warning",
        showCancelButton:true,
        confirmButtonColor:'#3085d6',
        cancelButtonText:'cancelar',
        confirmButtonText:'Sim, remover.'
    })
    .then((result) => {
        if(result.value) {
            axios.get('/api/delete_cliente/'+id)
              .then(() => {
                  Swal.fire(
                      'Deletado',
                      'Produto removido com sucesso.',
                      'success'
                  )

                  getClientes()
              })
              .catch(() => {
                  Swal.fire("Falhou.","Ocorreu algum erro.","Warning");
              })
        }
    })
}

</script>

<template>
    <div class="container">
        <div class="customers__titlebar dflex justify-content-between align-items-center">
                <div class="customers__titlebar--item">
                    <h1 class="my-1">Clientes</h1>
                </div>
                <div class="customers__titlebar--item">
                    <button class="btn btn-secondary my-1" @click="newCliente">
                        Adicionar Cliente
                    </button>
                </div>
            </div>
      <table>
  <tr>
    <th>Foto</th>
    <th>Nome</th>
    <th>RG</th>
    <th>Email</th>
    <th>Telefone</th>
    <th>endereço</th>
    <th>Açoes</th>
  </tr>
  <tr v-for="pessoa in clientes" :key="pessoa.id">
    <td><img class="products__list__item--img" :src="ourImage(pessoa.foto)"  style="height: 40px;" v-if="pessoa.foto"></td>
    <td>{{ pessoa.nome }}</td>
    <td>{{ pessoa.rg }}</td>
    <td>{{ pessoa.email }}</td>
    <td>{{ pessoa.telefone }}</td>
    <td>{{ pessoa.endereço }}</td>
    <td>                  
        <button class="btn-icon btn-icon-success" @click="onEdit(pessoa.id)">
            <i class="fas fa-pencil-alt"></i>
        </button>
        <button class="btn-icon btn-icon-danger" @click="deleteCliente(pessoa.id)">
            <i class="far fa-trash-alt"></i>
        </button>
    </td>
  </tr>
</table>

    </div>
</template>