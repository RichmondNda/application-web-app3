<template>
    <div>
        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
            <div class="grid grid-cols-2">
                <jet-application-logo class="block h-12 w-auto" />
                <div class="mt-2 mb-4 font-semibold bg-green-100 px-2 py-4 rounded-md text-center" v-if="$page.props.flash.success">
                    <span class="text-graw-800 font-bold text-md  p-4" v-if="$page.props.flash.success">{{$page.props.flash.success}}</span>
                </div>
            </div>

            <div class="mt-8 text-2xl text-center">
                Bienvenue sur votre tableau de Bord!
                
            </div>

            <div class="mt-6 text-md text-center text-gray-500">
                Merci d'avoir choisi notre plate-forme. Vous pouvez suivre l'évolution de  toutes 
                vos demandes à travers ce tableau ce bord.
            </div>
        </div>

        <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2">
            <div v-for="demande in mesDemandes" :key="demande.id" class="p-6 border-t border-gray-200 md:border-l">
                <div class="flex items-center">
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-400"><path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">{{demande.type}}</div>
                </div>

                <div class="ml-12">
                    <div class="mt-2 text-sm text-gray-500">
                        <p class="text-xl font-medium" v-if="demande.codeGenerer!='NULL'"> Code de déclaration : <span class="font-bold text-red-700">{{demande.codeGenerer}}</span> </p>
                        <div class="bg-gray-300 rounded-md m-3 h-7 w-full border-1 border-gray-800" >
                            <div class="bg-green-500 rounded-md h-7  text-center text-xl font-bold text-black" :style="'width:'+demande.status+'%'"> {{demande.status+'%'}}  </div>
                        </div>
                        <p v-if="demande.status==100" class="text-center text-gray-500 font-thin">LA DÉCLARATION A ETE EFECTUE AVEC SUCCESS</p>
                        <p v-if="demande.status==25" class="text-center text-gray-500 font-mono">LA PROCHAINE ETAPE EST LA <button class="font-bold text-gray-800" @click.prevent="valDetail(demande.id)">VALIDATION</button></p>
                        <p v-if="demande.status==50" class="text-center text-gray-500 font-light">LA PROCHAINE ETAPE EST LA <button class="font-bold text-gray-800" @click="confDetail(demande.id)">CONFIRMATION A LA MAIRIE</button></p>
                        <div v-if="validation_detail==demande.id && demande.status==25" class="m-3">
                            <span class="font-semibold text-md text-yellow-400"> Détails sur la validation</span>
                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aspernatur eveniet veniam deleniti modi fuga, vel, adipisci voluptate provident laudantium eius ut quod, nulla eaque totam tenetur repudiandae voluptatibus earum quia.
                        </div>
                        <div v-if="demande.status==50 && demande.id==confirmation_detail" class="m-3">
                            <span class="font-semibold text-md text-yellow-400"> Details sur la validation</span>
                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aspernatur eveniet veniam deleniti modi fuga, vel, adipisci voluptate provident laudantium eius ut quod, nulla eaque totam tenetur repudiandae voluptatibus earum quia.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import JetApplicationLogo from '@/Jetstream/ApplicationLogo'
import Button from '../../Jetstream/Button.vue'

    export default {
        components: {
            JetApplicationLogo,
        
                Button},
        data(){
            return{
                mesDemandes : null,
                validation_detail : null,
                confirmation_detail : null
            }
        },
        mounted(){
            this.getDemandes()
        },
        computed:{
            
        },
        methods:{
            getDemandes()
            {
                axios.get('/mes-demandes')
                    .then(response => {
                        this.mesDemandes = response.data
                    })
            },
            confDetail(id)
            {
                this.confirmation_detail=  id      
            },
            valDetail(id)
            {
                this.validation_detail = id
            }
            
            
        }
    }
</script>
