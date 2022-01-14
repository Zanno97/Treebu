<template>
  <div class="w-full max-w-screen-bg mx-auto px-52 py-4">
    <div class="bg-lime-100 px-10 py-5 rounded">
      <div class="flex items-center mb-5">
        <div class="ml-auto mr-3">Ordina per prezzo:</div>
        <span
          class="rounded-lg p-2 uppercase text-xs mr-2 cursor-pointer"
          :class="{
            'bg-green-300 text-black': sortMethod == 'asc',
            'bg-gray-300 text-gray-800 hover:bg-green-100': sortMethod != 'asc',
          }"
          @click="sort('asc')"
          >Crescente</span
        >
        <span
          class="rounded-lg p-2 uppercase text-xs cursor-pointer"
          :class="{
            'bg-green-300 text-black': sortMethod == 'desc',
            'bg-gray-300 text-gray-800 hover:bg-green-100': sortMethod != 'desc',
          }"
          @click="sort('desc')"
          >Decrescente</span
        >
      </div>
      <div class="grid grid-cols-3 gap-x-5 gap-y-5 bg-lime-100">
        <div
          class="bg-gray-200 rounded flex flex-col p-3"
          v-for="land in lands"
          :key="land.id"
        >
          <div
            class="h-56 w-full bg-white cursor-pointer"
            @click="goToDetail(land)"
          >
            <img class="w-full h-full" :src="land.photo" alt="" />
          </div>
          <div class="flex flex-row items-center pt-3">
            <div class="flex-grow">
              {{ land.common }}
            </div>
            <div class="flex">
              <h2 class="ml-auto text-green-600 font-bold text-xl">
                {{ land.price }} €
              </h2>
            </div>
          </div>
          <div class="mt-3 ml-auto space-x-3">
            <button
              class="text-yellow-600 text-sm font-bold hover:text-yellow-900"
              @click="edit(land)"
            >
              Modifica
            </button>
            <button
              class="text-green-600 text-sm font-bold hover:text-green-900"
              @click="deleteLand(land)"
            >
              Elimina
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";

export default {
  name: "ListLands",
  data() {
    return {
      lands: [],
      sortMethod: "asc",
    };
  },
  async mounted() {
    await this.getLands();
  },
  methods: {
    async getLands() {
      let response = await axios.get(
        "http://localhost:8000/api/lands?sort=" + this.sortMethod
      );
      this.lands = response.data;
    },
    edit(land) {
      this.$router.push("/edit/" + land.id);
    },
    goToDetail(land) {
      this.$router.push("/view/" + land.id);
    },
    async deleteLand(land) {
      if (
        confirm(
          "Vuoi davvero eliminare il terreno: " + land.common + "?",
          "Si",
          "No"
        )
      ) {
        await axios.delete("http://localhost:8000/api/lands/" + land.id);
        await this.getLands();
      }
    },
    sort(direction) {
      if (this.sortMethod != direction) {
        this.sortMethod = direction;
        this.getLands();
      }
    },
  },
};
</script>
