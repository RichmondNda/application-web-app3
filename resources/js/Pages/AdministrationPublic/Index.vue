<template>
  <div >
     <div class=" pt-32 h-screen bg-gray-50 ">
      <div class="grid grid-cols-5 gap-4">
        <div class="col-span-2 p-3">
            <div class=" mt-10 bg-gray-50 px-5 rounded-xl h-16 w-32 py-4">
                <img alt="Soutra logo" src="images/SoutraLogo.png">
            </div>
             <div class=" mt-2 text-black text-center text-xl">
                <span class="font-bold text-6xl  text-red-900">E</span> 
                <span class="font-bold text-6xl text-black">-</span> 
                <span class="font-bold text-6xl text-yellow-400">Administration</span> 
                est une plateforme développée par  des étudiants  de l'Ecole Supérieure Africaine des Technologies 
                de l'Information et de la Communication (<span class="font-bold text-red-800">ESATIC</span>) Pour la vérification 
                des dossiers administratifs.

                
            </div>
        </div>

        <div class="col-span-3 p-6">
            <div class="p-6 m-12 bg-white shadow-md rounded-xl  transform rotate-1">

                <div class="m-2 mb-4 bg-red-100 px-2 py-4 rounded-sm text-center" v-if="$page.props.flash.error">
                           <span class="text-gray-800 font-bold text-md  p-4" v-if="$page.props.flash.error">{{$page.props.flash.error}}</span>
                    </div>

                <div class="text-2xl  text-center font-bold  text-black">Login</div>
                <!-- formulaire -->
                <form @submit.prevent="Login()">
                    <div class="m-8">
                        <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700
                        leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-yellow-100 focus:border-transparent"  v-model="form.email" placeholder="E-mail"> 
                        <span class="text-red-800 font-bold text-sm  p-4" v-if="$page.props.errors.email">{{$page.props.errors.email}}</span>
   
                    </div>
                    <div class="m-8">
                        <input type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700
                        leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-yellow-100 focus:border-transparent " v-model="form.password" placeholder="Password">    
                        <span class="text-red-800 font-bold text-sm  p-4" v-if="$page.props.errors.password">{{$page.props.errors.password}}</span>
                    </div>
                    <div class="m-8 flex justify-end pr-6">
                        <!-- bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-opacity-50 -->
                        <button class=" bg-gradient-to-r from-red-600 to-red-900 text-white font-bold py-2 px-4 rounded-lg
                                focus:outline-none focus:shadow-outline border border-yellow-900" type="submit"> Envoyer</button>
                            
                        
                    </div>
                </form>
            </div>
        </div>
        
    </div>
  </div>
  </div>
</template>

<script>
export default {

    data(){
        return {
            form:{},
            errors:{}
        }
    }
    ,
    methods:{
        Login()
        {
            this.$inertia.post('Admin-login', this.form)
        }
    }

}
</script>

<style>

</style>