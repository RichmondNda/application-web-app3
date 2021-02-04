<template>
   <app-layout>
       <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Declaration de Naissance 
            </h2>
        </template>

       <div>
            <div class="p-2 shadow-md rounded-xl  ">

                <!-- <div class="text-2xl font-semibold  text-red-800">Déclaration  de Naissance  </div> -->
                <!-- formulaire -->
                <form @submit.prevent="submit()">
                    <div class="grid grid-cols-3 mt-8">
                        <div class="p-4">
                            <p class="text-md mb-8 font-semibold text-gray-500"> Information sur l'enfant </p> 
                                <div class="text-gray-400">
                                    <span class="text-md font-bold text-yellow-400"> Aide Dans le choix du nom </span>
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis perferendis magnam in corrupti nihil rem voluptatibus velit labore dolores, delectus, obcaecati ipsam, quisquam quis quo nemo quas aut nobis inventore.
                                </div>
                            <div class="m-8 ">
                                <label for="nom_enfant" class="flex justify-start font-medium text-md text-gray-800 "> Nom de l'enfant </label>
                                <input type="text" v-model="form.nom"  id="nom_enfant" class="mt-2 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700
                                    leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-yellow-200 focus:border-transparent " placeholder="N'DA">
                                 <span class="text-red-800 font-bold text-sm  p-4" v-if="$page.props.errors.nom">{{$page.props.errors.nom}}</span>    
                            </div>
                            <div class="m-8">
                                <label for="prenom_enfant" class="flex justify-start font-medium text-md text-gray-800 "> Prenom de l'enfant </label>
                                <input type="text" v-model="form.prenom"  id="prenom_enfant" class="mt-2 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700
                                    leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-yellow-200 focus:border-transparent " placeholder="REGIS RICHMOND ">    
                                <span class="text-red-800 font-bold text-sm  p-4" v-if="$page.props.errors.prenom">{{$page.props.errors.prenom}}</span>
                            </div>

                            <div class="m-8 flex justify-end pr-6">
                                <button class=" bg-gradient-to-r from-yellow-200 to-yellow-400 text-black font-bold py-2 px-4 rounded-lg
                                        focus:outline-none focus:shadow-outline border border-yellow-900" type="submit"> Envoyer ma declaration</button>
                            </div>
                    
                        </div>
                        <div class="col-span-2 border-l-2 p-6 border-red-800">
                            <div>
                                <p class="text-md font-semibold flex justify-start text-gray-400"> Information sur le pere  </p> 
                            
                                <div class="grid grid-cols-2">
                                    
                                    <div class="m-4">
                                        <label for="nom_pere_enfant" class="flex justify-start font-medium text-md text-gray-800 "> Nom du pere  </label>
                                        <input type="text" v-model="form.nom_pere"  id="nom_pere_enfant"  class="mt-2 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700
                                            leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-yellow-200 focus:border-transparent " placeholder="REGIS RICHMOND "> 
                                         <span class="text-red-800 font-bold text-sm  p-4" v-if="$page.props.errors.nom_pere">{{$page.props.errors.nom_pere}}</span>

                                    </div>
                                    <div class="m-4">
                                        <label for="prenom_pere_enfant" class="flex justify-start font-medium text-md text-gray-800 "> Prenom du pere  </label>
                                        <input type="text" v-model="form.prenom_pere"  id="prenom_pere_enfant" class="mt-2 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700
                                            leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-yellow-200 focus:border-transparent " placeholder="REGIS RICHMOND ">    
                                        <span class="text-red-800 font-bold text-sm  p-4" v-if="$page.props.errors.prenom_pere">{{$page.props.errors.prenom_pere}}</span>

                                    </div>
                                    
                                </div>
                                    <div class="grid grid-cols-2">
                                        <div class="m-4">
                                        <label for="num_tel_pere_enfant" class="flex justify-start font-medium text-md text-gray-800 "> Numero de telephone du pere  </label>
                                        <input type="text" v-model="form.numero_tel_pere"  id="num_tel_pere_enfant" class="mt-2 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700
                                            leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-yellow-200 focus:border-transparent " placeholder="REGIS RICHMOND "> 
                                        <span class="text-red-800 font-bold text-sm  p-4" v-if="$page.props.errors.numero_tel_pere">{{$page.props.errors.numero_tel_pere}}</span>
   
                                    </div>
                                    <div class="m-4">
                                        <label for="num_cni_pere_enfant" class="flex justify-start font-medium text-md text-gray-800 "> Numero de Carte Nationale D'identité du Pere </label>
                                        <input type="text" v-model="form.num_cni_pere"  id="num_cni_pere_enfant" class="mt-2 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700
                                            leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-yellow-200 focus:border-transparent " placeholder="REGIS RICHMOND "> 
                                        <span class="text-red-800 font-bold text-sm  p-4" v-if="$page.props.errors.num_cni_pere">{{$page.props.errors.num_cni_pere}}</span>
   
                                    </div>
                                                                        
                                </div>

                            </div>
                            <div class="mt-5">
                                <p class="text-md font-semibold flex justify-start text-gray-400"> Information sur la mere    </p> 
                            
                                <div class="grid grid-cols-2">
                                    
                                    <div class="m-4">
                                        <label for="nom_mere_enfant" class="flex justify-start font-medium text-md text-gray-800 "> Nom de la mere   </label>
                                        <input type="text" v-model="form.nom_mere"  id="nom_mere_enfant" class="mt-2 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700
                                            leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-yellow-200 focus:border-transparent " placeholder="REGIS RICHMOND ">    
                                        <span class="text-red-800 font-bold text-sm  p-4" v-if="$page.props.errors.nom_mere">{{$page.props.errors.nom_mere}}</span>

                                    </div>
                                    <div class="m-4">
                                        <label for="prnenom_mere_enfant" class="flex justify-start font-medium text-md text-gray-800 "> Prenom de la mere  </label>
                                        <input type="text" v-model="form.prenom_mere"  id="prnenom_mere_enfant" class="mt-2 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700
                                            leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-yellow-200 focus:border-transparent " placeholder="REGIS RICHMOND ">    
                                        <span class="text-red-800 font-bold text-sm  p-4" v-if="$page.props.errors.prenom_mere">{{$page.props.errors.prenom_mere}}</span>

                                    </div>
                                </div>
                                <div class="grid grid-cols-2">
                                        <div class="m-4">
                                        <label for="num_tel_mere_enfant" class="flex justify-start font-medium text-md text-gray-800 "> Numero de telephone de la Mere  </label>
                                        <input type="text" v-model="form.numero_tel_mere"  id="num_tel_mere_enfant" class="mt-2 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700
                                            leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-yellow-200 focus:border-transparent " placeholder="REGIS RICHMOND ">    
                                        <span class="text-red-800 font-bold text-sm  p-4" v-if="$page.props.errors.prenom">{{$page.props.errors.prenom}}</span>

                                    </div>
                                    <div class="m-4">
                                        <label for="num_cni_mere_enfant" class="flex justify-start font-medium text-md text-gray-800 "> Numero de Carte Nationale D'identité de la Mere </label>
                                        <input type="text" v-model="form.num_cni_mere" id="num_cni_mere_enfant" class="mt-2 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700
                                            leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-yellow-200 focus:border-transparent " placeholder="REGIS RICHMOND ">    
                                        <span class="text-red-800 font-bold text-sm  p-4" v-if="$page.props.errors.num_cni_mere">{{$page.props.errors.num_cni_mere}}</span>

                                    </div>
                                                                        
                                </div>

                            </div>
                            
                        </div>
                    </div>
                
                    
                </form>
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
    props :['code'],
    data(){
        return {
            form :{
                nom : null,
                prenom : null,
                nom_pere : null,
                prenom_pere: null,
                numero_tel_pere: null,
                num_cni_pere: null,
                nom_mere : null,
                prenom_mere: null,
                numero_tel_mere: null,
                num_cni_mere: null,
                Code_Generer : this.code
            }
        }
    },
    methods:{
        reset()
        {
            this.form.nom = null
            this.form.prenom = null
            this.form.nom_pere = null
            this.form.prenom_pere= null
            this.form.numero_tel_pere= null
            this.form.num_cni_pere= null
            this.form.nom_mere = null
            this.form.prenom_mere= null
            this.form.numero_tel_mere= null
            this.form.num_cni_mere= null    
       },
        submit()
        {
            // console.log(this.code)
            this.$inertia.post('/SendInfoDecChild',this.form)
                .then((response) => {
                     this.reset();
                }).catch((err) => {
                    
                });
        }
    }
}
</script>
