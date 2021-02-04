<template>
  <div >
     <div class=" pt-2 h-screen bg-gray-50 ">
      <div class="grid grid-cols-5 gap-4">
        <div class="col-span-2 pt-16 p-3">
            <div class=" bg-gray-50 px-5 rounded-xl h-16 w-32 py-4">
                <img alt="Soutra logo" src="images/SoutraLogo.png">
            </div>
             <div class=" mt-2 text-black text-center text-md">
                <span class="font-bold text-6xl  text-red-900">E</span> 
                <span class="font-bold text-6xl text-black">-</span> 
                <span class="font-bold text-6xl text-yellow-400">Administration</span> 
                est une plateforme dévellopée par  des etudiants  de l'Ecole Supérieur Africaine des Technologies 
                de l'Information et de la Communication (<span class="font-bold text-red-800">ESATIC</span>) Pour la verification 
                des dossiers administratifs.
                           
            </div>
             <div  class=" mt-8 mb-3 text-2xl text-center font-semibold  underline text-black">Scanner un fichier </div>

            <div class="px-2 py-4 text-center  rounded-md ">
                <qrcode-capture  @decode="onDecode" />
            </div>
        </div>

        <div class="col-span-3 p-6">
            <div class="p-6  bg-white shadow-md rounded-xl  transform rotate-1">
                
                <div>
                    <p class="error">{{ error }}</p>

                    <p class="decode-result">Last result: <b>{{ result }}</b></p>
                    <div class="rounded-sm  ">
                         <qrcode-stream @decode="onDecode" @init="onInit" />
                    </div>

                    <!-- <div class="text-2xl text-center font-semibold  text-black">SCANNER</div> -->
                    
                </div>
            
            </div>
        </div>
        
    </div>
  </div>
  </div>
</template>

<script>

import { QrcodeStream } from 'vue-qrcode-reader'

import { QrcodeCapture } from 'vue-qrcode-reader'

export default {

  components: { QrcodeStream , QrcodeCapture},

  data () {
    return {
      result: '',
      error: '',
      CodeDecripter:null
    }
  },

  computed:{
    
  },

  methods: {
    onDecode (result) {
      this.result = result
     
    },

    async onInit (promise) {
      try {
        await promise
      } catch (error) {
        if (error.name === 'NotAllowedError') {
          this.error = "ERROR: you need to grant camera access permisson"
        } else if (error.name === 'NotFoundError') {
          this.error = "ERROR: no camera on this device"
        } else if (error.name === 'NotSupportedError') {
          this.error = "ERROR: secure context required (HTTPS, localhost)"
        } else if (error.name === 'NotReadableError') {
          this.error = "ERROR: is the camera already in use?"
        } else if (error.name === 'OverconstrainedError') {
          this.error = "ERROR: installed cameras are not suitable"
        } else if (error.name === 'StreamApiNotSupportedError') {
          this.error = "ERROR: Stream API is not supported in this browser"
        }
      }
    }
  }
}
</script>

<style>

</style>