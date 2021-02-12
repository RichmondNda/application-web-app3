<template >
  <div class="bg-gray-300 h-100">
    <div class=" pt-16 text-center">
      <span class="text-6xl font-bold text-yellow-400">E</span>
      <span class="text-6xl  font-bold">-</span>
      <span class="text-6xl font-bold text-red-700">sign</span>
    </div>
     <div class="grid  pt-14 pb-36 grid-cols-5">

       <div></div>

       <div class="col-span-3 h-96 p-2  rounded-md shadow-xl bg-yellow-400"> 

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