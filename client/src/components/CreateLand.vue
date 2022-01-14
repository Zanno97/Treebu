<template>
  <div class="w-full max-w-screen-md mx-auto py-8 px-3">
    <div class="flex flex-col mb-3" v-for="field in fields" :key="field.code">
      <label class="mb-2 font-bold text-green-900" :for="field.code">{{
        field.label
      }}</label>
      <input
        v-if="field.type == 'text'"
        class="border border-gray-200 p-2 rounded"
        type="text"
        :id="field.code"
        v-model="newLand[field.code]"
      />
      <input
        v-if="field.type == 'number'"
        class="border border-gray-200 p-2 rounded"
        type="number"
        :id="field.code"
        v-model="newLand[field.code]"
      />
      <select
        v-if="field.type == 'select'"
        class="border border-gray-200 p-2 rounded bg-white"
        :name="field.code"
        :id="field.code"
        v-model="newLand[field.code]"
      >
        <option
          v-for="option in field.options"
          :key="option.code"
          :value="option.code"
        >
          {{ option.label }}
        </option>
      </select>
      <input
        v-if="field.type == 'checkbox'"
        class="border border-gray-200 p-2 rounded"
        type="checkbox"
        :id="field.code"
        v-model="newLand[field.code]"
      />
      
    </div>
    <div class="pt-3">
      <button
        @click="createLand()"
        :disabled="!formIsValid"
        class="disabled:bg-gray-300 disabled:cursor-not-allowed p-2 px-3 rounded bg-green-800 text-white"
      >
        {{ $route.name == "edit_land" ? "Salva" : "Crea" }}
      </button>
    </div>
  </div>
</template>
<script>
import axios from "axios";

export default {
  name: "CreateLand",
  data() {
    return {
      fields: [
        {
          label: "Comune",
          code: "common",
          type: "text",
        },
        {
          label: "Foto",
          code: "photo",
          type: "text",
        },
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
        {
          label: "Disponibile",
          code: "available",
          type: "checkbox",
        },
      ],
      newLand: {
        common: "",
        photo: "",
        dimension: 0,
        sheet: "",
        map: "",
        parcel: "",
        type: "clay",
        irrigation: "flow",
        offer: "sale",
        price: 0,
        available: 1,
      },
    };
  },
  async mounted() {
    if (this.$route.name == "edit_land") {
      let response = await axios.get(
        "http://localhost:8000/api/lands/" + this.$route.params.id
      );
      this.newLand = response.data;
    }
  },
  methods: {
    async createLand() {
      if (this.$route.name == "edit_land") {
        let response = await axios.put(
          "http://localhost:8000/api/lands/" + this.$route.params.id,
          this.newLand
        );

        if (response.status == 200) {
          this.$router.push("/");
        }
      } else {
        let response = await axios.post(
          "http://localhost:8000/api/lands",
          this.newLand
        );

        if (response.status == 201) {
          this.$router.push("/");
        }
      }
    },
  },
  computed: {
    formIsValid() {
      return (
        this.newLand.common != "" &&
        this.newLand.photo != "" &&
        this.newLand.dimension > 0 &&
        this.newLand.sheet != "" &&
        this.newLand.map != "" &&
        this.newLand.parcel != "" &&
        this.newLand.type != "" &&
        this.newLand.irrigation != "" &&
        this.newLand.offer != "" &&
        this.newLand.price > 0 
      );
    },
  },
};
</script>
