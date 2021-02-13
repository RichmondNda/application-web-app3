<template >
  <div class="bg-gray-300 h-100">
    <div class=" pt-4  flex flex-wrap content-between "> 
      <!-- md:pl-96  md:ml-52 -->
          <img alt="Soutra logo" class="  h-16 w-32" src="images/SoutraLogo.png">
  
    </div>
     <div class="grid  pt-14 pb-36 grid-cols-7">

       <div></div>

       <div class="col-span-5 md:h-96  sm:h-64 p-2  rounded-md shadow-xl bg-yellow-400"> 

          <VueSignaturePad class="bg-gray-50" ref="signaturePad" />
          <div class="m-8 justify-between flex  p-5 mt-8">
            <button @click="save" class="text-xl font-semibold text-white bg-red-700 px-4 py-2 rounded-md shadow-md" >Sauvegarder</button>
            <button @click="undo" class="text-xl font-semibold text-black bg-yellow-400 px-4 py-2 rounded-md shadow-md" >Effacer</button>
          </div>

       </div>

       <div></div>

     </div>
   

  </div>
</template>
<script>
export default {
  name: 'MySignaturePad',
  methods: {
    undo() {
      this.$refs.signaturePad.undoSignature();
    },
    save() {
      const { isEmpty, data } = this.$refs.signaturePad.saveSignature();
      // console.log(isEmpty);
      // console.log(data);

      axios.post('ok-signature', {'signed' : data })
          .then((response)=> {
            console.log(response.data)
             if (response.data.success==true)
             {
                
             }
          })
    }
  }
};
</script>