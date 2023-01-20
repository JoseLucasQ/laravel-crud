<script setup>
    import { toStatement } from "@babel/types";
    import { ref } from "vue"
    import { useRouter } from "vue-router";

    const router = useRouter()

    let form = ref({
        nome:''
    })

    const getPhoto = () => {
        let photo = "/upload/image.png"
        if(form.value.photo){
            if(form.value.indexOf('base64') != -1){
                photo = form.value.photo
            }else{
                photo = '/upload/'+form.value.photo
            }
        }
        return photo
    }

    const saveCliente = () => {
        const formData = new FormData()
        formData.append('nome', form.value.nome)
        formData.append('rg', form.value.rg)
        formData.append('email', form.value.email)
        formData.append('numero', form.value.numero)
        formData.append('endereço', form.value.endereço)

        axios.post("/api/add_cliente",formData)
        .then((response)=>{
            form.value.name=''
            form.value.rg=''
            form.value.email=''
            form.value.numero=''
            form.value.endereço=''

            router.push('/')

            toStatement.fire({
                icon:"sucess",
                title:"Cliente adicionado com sucesso"
            })

        })
        .catch((error) => {

        })
    }

</script>

<template>
    <div class="container">
        <div class="products__create ">
    
    <div class="products__create__titlebar dflex justify-content-between align-items-center">
        <div class="products__create__titlebar--item">
            
            <h1 class="my-1">Adicionar Cliente</h1>
        </div>
        <div class="products__create__titlebar--item">
            
        </div>
    </div>

    <div class="products__create__cardWrapper mt-2">
        <div class="products__create__main">
            <div class="products__create__main--addInfo card py-2 px-2 bg-white">
                <p class="mb-1">Nome</p>
                <input type="text" class="input" v-model="form.nome">

                <p class="my-1">RG</p>
                <input type="text" class="input" v-model="form.rg">

                <p class="my-1">Email</p>
                <input type="text" class="input" v-model="form.email">

                <p class="my-1">Numero de Telefone</p>
                <input type="text" class="input" v-model="form.numero">

                <p class="my-1">Endereço</p>
                <input type="text" class="input" v-model="form.endereço">
                
                <!--<div class="products__create__main--media--images mt-2">
                   <ul class="products__create__main--media--images--list list-unstyled">
                       <li class="products__create__main--media--images--item">
                           <div class="products__create__main--media--images--item--imgWrapper">
                               <img class="products__create__main--media--images--item--img" alt="" />  
                           </div>
                       </li>-->
                       <!-- upload image small -->
                       <!--<li class="products__create__main--media--images--item">
                           <form class="products__create__main--media--images--item--form">
                               <label class="products__create__main--media--images--item--form--label" for="myfile">Add Image</label>
                               <input class="products__create__main--media--images--item--form--input" type="file" id="myfile" >
                           </form>
                       </li>
                   </ul>
               </div>-->
           
            </div>

        </div>
    </div>
    <!-- Footer Bar -->
    <div class="dflex justify-content-between align-items-center my-3">
        <p ></p>
        <button class="btn btn-secondary" @click="saveCliente()" >Save</button>
    </div>

</div>
    </div>
</template>