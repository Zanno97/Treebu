<template>
  <div class="w-full max-w-screen-md mx-auto py-8 px-3">
    <div class="bg-lime-100 rounded px-10 py-5">
      <div class="flex items-end">
        <h1 class="font-bold text-3xl">{{ land.common }}</h1>
        <h2 class="ml-auto text-green-600 font-bold text-2xl">
          {{ land.price }} €
        </h2>
      </div>
      <div class="flex mt-5 items-stretch">
        <div class="h-56 w-56 w-full bg-white cursor-pointer mr-8">
          <img class="w-full h-full" :src="land.photo" alt="" />
        </div>
        <div class="flex flex-col justify-between flex-grow">
          <div
            v-for="field in fields"
            :key="field.code"
            class="border-b border-gray-600 flex items-center"
          >
            <span>
              {{ field.label }}
            </span>
            <span class="ml-auto font-bold">
              {{ land[field.code] }}
            </span>
          </div>
        </div>
      </div>
      <div>
        <button
          @click="goToList()"
          class="text-gray-500 text-sm cursor-pointer mt-5 hover:text-black"
        >
          Torna indietro
        </button>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";

export default {
  name: "ViewLand",
  data() {
    return {
      land: {},
      fields: [
        {
          label: "Dimensioni (ettari)",
          code: "dimension",
          type: "number",
        },
        {
          label: "Foglio Catastale",
          code: "sheet",
          type: "text",
        },
        {
          label: "Mappa Catastale",
          code: "map",
          type: "text",
        },
        {
          label: "Parcella Catastale",
          code: "parcel",
          type: "text",
        },
        {
          label: "Tipologia Terreno",
          code: "type",
          type: "select",
          options: [
            {
              label: "Argilloso",
              code: "clay",
            },
            {
              label: "Sabbioso",
              code: "sand",
            },
            {
              label: "Ghiaioso",
              code: "gravel",
            },
            {
              label: "Tufo",
              code: "tuff",
            },
          ],
        },
        {
          label: "Tipologia Irrigazione",
          code: "irrigation",
          type: "select",
          options: [
            {
              label: "Scorrimento",
              code: "flow",
            },
            {
              label: "Pozzo",
              code: "well",
            },
            {
              label: "Canale",
              code: "canal",
            },
            {
              label: "Senz'acqua",
              code: "no_water",
            },
          ],
        },
        {
          label: "Offerta",
          code: "offer",
          type: "select",
          options: [
            {
              label: "Vendita",
              code: "sale",
            },
            {
              label: "Affitto",
              code: "rent",
            },
            {
              label: "Affitto Gratuito",
              code: "free_rent",
            },
          ],
        },
        {
          label: "Canone Offerta",
          code: "price",
          type: "number",
        },
      ],
    };
  },
  async mounted() {
    let landId = this.$route.params.id;

    let response = await axios.get(
      "http://localhost:8000/api/lands/" + landId
    );
    console.log(response);
    this.land = response.data;
  },
  methods: {
    goToList() {
      this.$router.push("/");
    },
  },
};
</script>
