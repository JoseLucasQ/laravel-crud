<script setup>
    import { assertExpressionStatement, toStatement } from '@babel/types';
    import { onMounted, ref, defineProps } from 'vue';
    import { useRouter } from 'vue-router';

    let form = ref({

        id:'',
        nome:'',
        rg:'',
        email:'',
        numero:'',
        endereço:''
    })

    onMounted(async () => {
        getSingleClient()
    })

    const props = defineProps({
        id:{
            type:String,
            default:''
        }
    })

    const getSingleClient = async () => {
        let response = await axios.get(`/api/get_edit_cliente/${props.id}`)
        form.value = response.data.cliente
    }
    
    const router = useRouter()

    const getPhoto = () => {
        let photo = "/upload/image.png"
        if(form.value.photo){
            if(form.value.photo.indexOf('base64') != -1){
                photo = form.value.photo
            }else{
                photo = '/upload/'+form.value.photo
            }
        }
        return photo
    }

    const updatePhoto = (e) => {

        let file = e.target.files[0];
        let reader = new FileReader();
        let limit = 1024 * 1024 * 2;
        if(file['size'] > limit) {
            return false
        }
        reader.onloadend = (file) => {
            form.value.photo = reader.result;
        }
        reader.readAsDataURL(file);
    }

    const updateCliente = () => {
        const formData = new FormData()
        formData.append('nome', form.value.nome)
        formData.append('rg', form.value.rg)
        formData.append('email', form.value.email)
        formData.append('numero', form.value.telefone)
        formData.append('endereço', form.value.endereço)
        formData.append('photo', form.value.photo)

        axios.post('/api/update_cliente/${form.value.id}', formData)
            .then((response)=> {
                form.value.name=''
                form.value.rg=''
                form.value.email=''
                form.value.numero=''
                form.value.endereço=''
                form.value.photo=''

                router.push('/')

                toast.fire({
                    icon:"sucess",
                    title:"Cliente atualizado com sucesso"
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
                <input type="text" class="input" v-model="form.telefone">

                <p class="my-1">Endereço</p>
                <input type="text" class="input" v-model="form.endereço">
                
                <div class="products__create__main--media--images mt-2">
                   <ul class="products__create__main--media--images--list list-unstyled">
                       <li class="products__create__main--media--images--item">
                           <div class="products__create__main--media--images--item--imgWrapper">
                               <img class="products__create__main--media--images--item--img" :src="getPhoto()" alt="" />  
                           </div>
                       </li>
                       <!-- upload image small -->
                       <li class="products__create__main--media--images--item">
                           <form class="products__create__main--media--images--item--form">
                               <label class="products__create__main--media--images--item--form--label" for="myfile">Add Image</label>
                               <input class="products__create__main--media--images--item--form--input" type="file" id="myfile" @change="updatePhoto" >
                           </form>
                       </li>
                   </ul>
               </div>
           
            </div>

        </div>
    </div>
    <!-- Footer Bar -->
    <div class="dflex justify-content-between align-items-center my-3">
        <p ></p>
        <button class="btn btn-secondary" @click="updateCliente()" >Save</button>
    </div>

</div>
    </div>
</template>