<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Dasboard
      </h2>
    </template>

    <div class="py-6">
      <div class=" ">
        <div class="grid grid-cols-5 gap-4">
          <div class="col-span-2">
            <div
              class="mt-4 mr-5 ml-5 mb-1 bg-red-100 transform -rotate-1 rounded-md px-2 py-4 rounded-sm text-center"
              v-if="$page.props.flash.error"
            >
              <span
                class="text-gray-800 font-bold text-md p-4"
                v-if="$page.props.flash.error"
                >{{ $page.props.flash.error }}</span
              >
            </div>

            <div
              class="p-4 pt-2transform -rotate-1 col-span-2 m-16 bg-white shadow-md rounded-xl"
            >
              <div class="text-xl font-semibold text-center text-black">
                Demande d'extrait
              </div>
              <!-- formulaire -->
              <form @submit.prevent="submit()">
                <div class="m-8">
                  <span class="text-xl text-gray-800 font-bold justify-start"
                    >N°</span
                  >
                  <input
                    type="text"
                    v-model="form.numero_extrait"
                    class="shadow appearance-none border rounded ml-5 w-56 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-yellow-100 focus:border-transparent"
                    placeholder="Numero d'extrait de naissance ..."
                  />
                  <span
                    class="text-red-800 flex justify-center font-bold text-sm p-2"
                    v-if="$page.props.errors.numero_extrait"
                    >{{ $page.props.errors.numero_extrait }}</span
                  >
                </div>

                <div class="m-2">
                  <span class="text-xl text-gray-800 font-bold justify-start"
                    >DU</span
                  >
                  <input
                    type="date"
                    v-model="form.vue_date_numero_extrait"
                    class="shadow appearance-none border rounded w-56 ml-5 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-yellow-100 focus:border-transparent"
                    placeholder="Numero d'extrait de naissance ..."
                  />
                  <span
                    class="text-red-800 flex justify-center font-bold text-sm p-2"
                    v-if="$page.props.errors.vue_date_numero_extrait"
                    >{{ $page.props.errors.vue_date_numero_extrait }}</span
                  >
                </div>
                <div class="m-2 flex justify-end pr-6">
                  <!-- bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-opacity-50 -->
                  <button
                    class="bg-gradient-to-r from-red-600 to-red-900 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline border border-yellow-900"
                    type="submit"
                  >
                    Envoyer
                  </button>
                </div>
              </form>
            </div>
          </div>
          <div class="p-6 col-span-3">
            <div>
              <div class="flex justify-end m-4">
                <div class="h-28 w-28">
                  <img
                    alt="Soutra logo"
                    src="images/undraw_sync_files_xb3r.svg"
                  />
                </div>
              </div>
            </div>

            <div class="m-8">
              la
              <span class="text-xl font-bold text-yellow-400">
                Demande d'extrait</span
              >
              est Lorem ipsum dolor sit amet consectetur, adipisicing elit.
              Doloribus eligendi ipsum necessitatibus animi voluptas, similique
              ut est labore neque dignissimos facilis eveniet tempora, dolores,
              possimus saepe nemo quos minima commodi.
            </div>
          </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";

export default {
  components: {
    AppLayout,
  },
  data() {
    return {
      form: {
        numero_extrait: null,
        vue_date_numero_extrait: null,
        date_numero_extrait: null,
        ville:'abidjan',

        code: null,
      },
      errors: {},
    };
  },
  methods: {
    reset() {
      (this.form.numero_extrait = null),
        (this.form.vue_date_numero_extrait = null);
    },
    submit() {
      let ex_date = new Date(this.form.vue_date_numero_extrait);

      if (ex_date.getMonth() + 1 < 10) {
        this.form.date_numero_extrait = 
          ex_date.getDate() +
          "/0" +
          (ex_date.getMonth() + 1) +
          "/" +
          ex_date.getFullYear();
      } else {
        this.form.date_numero_extrait =
          ex_date.getDate() +
          "/" +
          (ex_date.getMonth() + 1) +
          "/" +
          ex_date.getFullYear();
      }

      this.form.code =
        ex_date.getDate() +
        "" +
        this.form.numero_extrait
        + ""+
        this.form.ville+
         "" +
         +""+
        ex_date.getFullYear() +
        (ex_date.getMonth() + 1) ;

      console.log(this.form.date_numero_extrait);

      this.$inertia
        .post("/demanderSonExtrait", this.form)
        .then((response) => {
          this.reset();
        })
        .catch((err) => {});
    },
  },
};
</script>

<style>
</style>