<template>

  <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
               Dasboard
            </h2>
        </template>

        <div class="py-6">
            <div class=" ">
     
                    <div class="grid grid-cols-5 mt-12  gap-4">

                        <div class="p-6 col-span-2 mt-20">
                            <div v-if="show_pdf_dwonloader">
                                <div class="flex justify-between m-4">
                                    <div class="p-10 text-gray-700">
                                        <span class="text-xl font-bold ">Télécharger votre extrait  -></span>
                                        <pre>(en cliquant sur l'image)</pre>
                                    </div>
                                    <div class=" h-28 w-28">
                                        <a target="blank"  :href="'/pdf-download/' + numero_acte +'-'+mask" > <img alt="Soutra logo" src="images/undraw_sync_files_xb3r.svg"> </a>
                                    </div>
                                </div>
                            </div>
        
                            <!-- <div class="m-8">
                                la 
                                <span class="text-xl font-bold text-yellow-400"> Demande d'extrait</span> est 
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Doloribus eligendi ipsum necessitatibus animi voluptas, similique ut est labore neque dignissimos facilis eveniet tempora, dolores, possimus saepe nemo quos minima commodi.
                            </div> -->
                        </div>

                    
                        <div class="col-span-3">

                            <div class="p-6 pt-6 transform -rotate-1   col-span-2 m-16 bg-white shadow-md rounded-xl  ">

                            <div class="text-xl font-semibold text-center   text-black">Paiement du timbre municipal </div>
                            <!-- formulaire -->
                            <form @submit.prevent="">
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="m-8">
                                    <span class="text-xl text-gray-800 font-bold justify-start">N° de carte banquaire : </span>
                                        <input type="text"  class="shadow appearance-none border rounded ml-5 w-56 py-2 px-3 text-gray-700
                                        leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-yellow-100 focus:border-transparent " >  
                                </div>
                                 <div class="m-8">
                                    <span class="text-xl text-gray-800 font-bold justify-start">N° de téléphone : </span>
                                        <input type="text" class="shadow appearance-none border rounded ml-5 w-56 py-2 px-3 text-gray-700
                                        leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-yellow-100 focus:border-transparent ">  
                                </div>
                                </div>
                                <div class="m-2 flex justify-between pr-6">
                                     <button class=" bg-gradient-to-r from-yellow-300 to-yellow-600 text-black font-bold py-2 px-4 rounded-lg
                                            focus:outline-none focus:shadow-outline border border-yellow-900" @click.prevent="pdfshow()"> Banque</button>
                                        
                                    <!-- bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-opacity-50 -->
                                    <button class=" bg-gradient-to-r from-red-600 to-red-900 text-white font-bold py-2 px-4 rounded-lg
                                            focus:outline-none focus:shadow-outline border border-yellow-900" @click.prevent="pdfshow()"> Mobile</button>
                                        
                                    
                                 </div>
                             </form>
                            </div>
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
        props:['extrait'],
        data(){
            return {
               
                show_pdf_dwonloader: false,
                numero_acte : null,
                mask: null
            }
        }, 
        methods:{
            pdfshow(){
                this.show_pdf_dwonloader = true
                this.numero_acte = this.extrait.numero_acte
                this.mask = this.extrait.code
                // alert(this.numero_acte)
            },
            reset(){
                // this.form.numero_extrait = null,
                // this.form.vue_date_numero_extrait = null
            },
            submit()
            {
                // let ex_date = new Date(this.form.vue_date_numero_extrait);

                
                // if(ex_date.getMonth()+1 < 10)
                // {
                //     this.form.date_numero_extrait = ex_date.getDate()+"/0"+(ex_date.getMonth()+1)+"/"+ex_date.getFullYear()
                // }
                // else{
                //     this.form.date_numero_extrait = ex_date.getDate()+"/"+(ex_date.getMonth()+1)+"/"+ex_date.getFullYear()
                // }

                // console.log(this.form.date_numero_extrait)


                // this.$inertia.post('/demanderSonExtrait', this.form)
                // .then((response) => {
                //      this.reset();
                // }).catch((err) => {
                    
                // });
            
            },

           
        }
    }
</script>

<style>

</style>