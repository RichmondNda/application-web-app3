<template>
    <app-layout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Declaration de Naissance 
            </h2>
        </template>
        
          <div class=" container">
            <div class="grid grid-cols-3 gap-8 p-2">
                

                <div class="col-span-2 p-14 ">

                    <p  class="mt-20 text-3xl font-bold text-red-800"> DECLARATION DE NAISSANCE </p >
                    <div class="mt-8">
                        <span class="text-yellow-300 font-semibold "> Explication des details </span>
                        <p class="mt-5">
                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Corporis deserunt similique animi sapiente odio rem at illo maxime consectetur ipsam laborum est quis, iusto pariatur natus quos? Perspiciatis, molestiae doloribus.
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Necessitatibus soluta laudantium quia voluptatum est commodi officiis ratione culpa ab placeat? Aspernatur at cum facilis tempore quasi similique eum nihil placeat!
                        </p>
                    </div>
                </div>
                <div class="p-4 pt-24">

                    <div class="mt-2 mb-4 bg-red-100 px-2 py-4 rounded-sm text-center" v-if="$page.props.flash.error">
                           <span class="text-gray-800 font-bold text-md  p-4" v-if="$page.props.flash.error">{{$page.props.flash.error}}</span>
                    </div>
                    
                    <div class="p-4 bg-white shadow-md rounded-xl  ">

                        <div class="text-xl font-semibold text-center text-black">Entrez le code de Déclaration </div>
                        <!-- formulaire -->
                        <form @submit.prevent="Declaration()">
                            <div class="m-8">
                                <input type="text" v-model="form.code" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700
                                leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-red-800 focus:border-transparent " placeholder="#1254JJJ">
                               <span class="text-red-800 font-bold text-sm  p-4" v-if="$page.props.errors.code">{{$page.props.errors.code}}</span>

                            </div>
                        
                            <div class="m-8 flex justify-end pr-6">
                                <!-- bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-opacity-50 -->
                                <button class=" bg-gradient-to-r from-yellow-200 to-yellow-400 text-black font-bold py-2 px-4 rounded-lg
                                        focus:outline-none focus:shadow-outline border border-yellow-900" type="submit"> Envoyer</button>
                                    
                                
                            </div>
                        </form>
                    </div>
                
                </div>
            </div>
          </div>

    </app-layout>
</template>

<script>

import AppLayout from '@/Layouts/AppLayout'

export default {
    components: {
            AppLayout
        },
    props : [],
    data(){
        return {
            form :{
                code : null
            },
            errors:{}
            
        }
    },
    methods :{
        reset(){
            this.form.code = null
        },
        Declaration()
        {
            this.$inertia.post('/declaration-new-nee-code',this.form)
                .then((response) => {
                     this.reset();
                }).catch((err) => {
                    
                });
            
        }
    }
}
</script>

