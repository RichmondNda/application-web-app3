<template>
    <app-layout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Declaration de DÉCÈS 
            </h2>
        </template>
        
          <div class=" container">
            <div class="grid grid-cols-3 gap-3">

                <div class="col p-4 mt-8 ">

                    <div class="mt-2 bg-red-100 px-2 py-4 rounded-sm text-center" v-if="$page.props.flash.error">
                           <span class="text-gray-800 font-bold text-md  p-4" v-if="$page.props.flash.error">{{$page.props.flash.error}}</span>
                    </div>

                    <p  class="mt-16 text-3xl font-bold text-red-800"> DECLARATION DE DÉCÈS </p >
                    <div class="p-4">
                        <span class="text-yellow-300 font-semibold "> Explication des details </span>
                        <p class="mt-2">
                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Corporis deserunt similique animi sapiente odio rem at illo maxime 
                        </p>
                    </div>
                </div>


                <div class="p-2 col-span-2 pt-8">

                    
                    
                    <div class="p-8 bg-white shadow-md rounded-xl  ">

                      
                        <!-- formulaire -->
                        <form @submit.prevent="Declaration()">

                            <span class="text-md text-gray-600 font-bold"> Information sur le déclarant</span>

                            <div class="grid grid-cols-3 p-4 gap-8">

                                <div>

                                   <label for="decl_num_extrait" class="flex justify-start font-mono text-md text-gray-800 "> Numero d'extrait </label>
                                    <input type="text" v-model="form.decl_num_extrait" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700
                                        leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-red-800 focus:border-transparent " placeholder="#1254JJJ">
                                    <span class="text-red-800 font-bold text-sm  p-4" v-if="$page.props.errors.decl_num_extrait">{{$page.props.errors.decl_num_extrait}}</span>
                                </div>
                            
                                <div>
                                    <label for="decl_date_extrait" class="flex justify-start font-mono text-md text-gray-800 "> date extrait </label>
                                    <input type="date" v-model="form.vue_decl_date_extrait" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700
                                        leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-red-800 focus:border-transparent " placeholder="#1254JJJ">
                                    <span class="text-red-800 font-bold text-sm  p-4" v-if="$page.props.errors.vue_decl_date_extrait">{{$page.props.errors.vue_decl_date_extrait}}</span>
                                </div>

                                <div>
                                    <label for="decl_ville_extrait" class="flex justify-start font-mono text-md text-gray-800 "> ville </label>
                                    <input type="text" v-model="form.decl_ville_extrait" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700
                                        leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-red-800 focus:border-transparent " placeholder="#1254JJJ">
                                    <span class="text-red-800 font-bold text-sm  p-4" v-if="$page.props.errors.decl_ville_extrait">{{$page.props.errors.decl_ville_extrait}}</span>

                                </div>
                            </div>

                            <span class="text-md text-gray-600 font-bol"> Information sur le défunt</span>

                            <div class="grid grid-cols-3 p-4 gap-8">

                                <div>

                                   <label for="mort_num_extrait" class="flex justify-start font-mono text-md text-gray-800 "> Numero d'extrait </label>
                                    <input type="text" v-model="form.mort_num_extrait" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700
                                        leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-red-800 focus:border-transparent " placeholder="#1254JJJ">
                                    <span class="text-red-800 font-bold text-sm  p-4" v-if="$page.props.errors.mort_num_extrait">{{$page.props.errors.mort_num_extrait}}</span>
                                </div>
                            
                                <div>
                                    <label for="mort_date_extrait" class="flex justify-start font-mono text-md text-gray-800 "> date extrait </label>
                                    <input type="date" v-model="form.vue_mort_date_extrait" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700
                                        leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-red-800 focus:border-transparent " placeholder="#1254JJJ">
                                    <span class="text-red-800 font-bold text-sm  p-4" v-if="$page.props.errors.vue_mort_date_extrait">{{$page.props.errors.vue_mort_date_extrait}}</span>
                                </div>

                                <div>
                                    <label for="mort_ville_extrait" class="flex justify-start font-mono text-md text-gray-800 "> ville </label>
                                    <input type="text" v-model="form.mort_ville_extrait" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700
                                        leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-red-800 focus:border-transparent " placeholder="#1254JJJ">
                                    <span class="text-red-800 font-bold text-sm  p-4" v-if="$page.props.errors.mort_ville_extrait">{{$page.props.errors.mort_ville_extrait}}</span>

                                </div>
                            </div>



                            <div class="grid grid-cols-3 p-4 gap-8">
                               <div>
                                    <label for="mort_ville_extrait" class="flex justify-start font-mono text-md text-gray-800 "> Lien avec le defunt </label>

                                    <div class="grid grid-cols-3 mt-2">
                                            <div class="flex items-center">
                                                <input id="pere" v-model="form.lien" value="pere" name="push_notifications" type="radio" class="focus:ring-indigo-500 h-6 w-6 md:h-3 md:w-3 text-indigo-600 border-gray-300">
                                                <label for="pere" class="ml-3 block text-sm font-medium text-gray-700">
                                                    Pére
                                                </label>
                                            </div>
                                            <div class="flex items-center">
                                                <input id="mere" v-model="form.lien" value="mere" name="push_notifications" type="radio" class="focus:ring-indigo-500 h-6 w-6 md:h-3 md:w-3 text-indigo-600 border-gray-300">
                                                <label for="mere" class="ml-3 block text-sm font-medium text-gray-700">
                                                    Mére
                                                </label>
                                            </div>
                                            <div class="flex items-center">
                                                <input id="conjoint" v-model="form.lien" value="conjoint" name="push_notifications" type="radio" class="focus:ring-indigo-500 h-6 w-6 md:h-3 md:w-3 text-indigo-600 border-gray-300">
                                                <label for="conjoint" class="ml-3 block text-sm font-medium text-gray-700">
                                                    Conjoint
                                                </label>
                                            </div>
                                    </div>
                                              <span class="text-red-800 font-bold text-sm  p-4" v-if="$page.props.errors.lien">{{$page.props.errors.lien}}</span>


                               </div>

                               <div>

                               </div>

                                <div>
                                    <span class="text-md text-red-900 font-bold "> CODE DE DÉCLARATION</span>
                                    <input type="text" v-model="form.code_validation" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700
                                        leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-red-800 focus:border-transparent " placeholder="#1254JJJ">
                                    <span class="text-red-800 font-bold text-sm  p-4" v-if="$page.props.errors.code_validation">{{$page.props.errors.code_validation}}</span>
                                </div>
                            </div>

                            <div class=" justify-center flex">
                                 <div class="">
                                    <!-- bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-opacity-50 -->
                                    <button class=" bg-gradient-to-r from-yellow-200 to-yellow-400 text-black font-bold py-2 px-4 rounded-lg
                                            focus:outline-none focus:shadow-outline border border-yellow-900" type="submit"> Envoyer</button>
                                </div>
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
                decl_num_extrait:null,
                decl_date_extrait:null,
                decl_ville_extrait:null,

                mort_num_extrait:null,
                mort_date_extrait:null,
                mort_ville_extrait:null,
                lien:null,

                code_validation:null,


                vue_decl_date_extrait:null,
                vue_mort_date_extrait:null,
            },
            errors:{}
            
        }
    },
    methods :{
        reset(){

            this.form.decl_num_extrait = null
            this.form.decl_date_extrait = null
            this.form.decl_ville_extrait = null

            this.form.mort_num_extrait = null
            this.form.mort_date_extrait = null
            this.form.mort_ville_extrait = null

            this.form.vue_decl_date_extrait = null
            this.form.vue_mort_date_extrait = null
            this.form.lien = null

            this.form.code_validation =null
        },
        Declaration()
        {

            let decl_ex_date = new Date(this.form.vue_decl_date_extrait);
            let mort_ex_date = new Date(this.form.vue_mort_date_extrait);

                
            if(decl_ex_date.getMonth()+1 < 10)
            {
                this.form.decl_date_extrait = decl_ex_date.getDate()+"/0"+(decl_ex_date.getMonth()+1)+"/"+decl_ex_date.getFullYear()
            }
            else{
                this.form.decl_date_extrait = decl_ex_date.getDate()+"/"+(decl_ex_date.getMonth()+1)+"/"+decl_ex_date.getFullYear()
            }

            if(mort_ex_date.getMonth()+1 < 10)
            {
                this.form.mort_date_extrait = mort_ex_date.getDate()+"/0"+(mort_ex_date.getMonth()+1)+"/"+mort_ex_date.getFullYear()
            }
            else{
                this.form.mort_date_extrait = mort_ex_date.getDate()+"/"+(mort_ex_date.getMonth()+1)+"/"+mort_ex_date.getFullYear()
            }

            this.$inertia.post('/declaration-new-deces-code',this.form)
                .then((response) => {
                     this.reset();
                }).catch((err) => {
                    
                });
            
        }
    }
}
</script>

