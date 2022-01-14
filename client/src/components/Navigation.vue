<template>
  <div class="flex items-center p-3 bg-green-200">
    <div @click="goToList()" class="cursor-pointer pl-10">
      <span class="text-emerald-300 bg-white rounded-l pl-2 py-2"> Green </span>
      <span class="text-green-400 font-bold bg-white rounded-r pr-2 py-2"> Land </span>
    </div>
    <div class="ml-auto">
      <button @click="createLand()" class="p-2 text-green-900 hover:bg-green-300 hover:text-white rounded pr-10">
        Aggiungi Terreno
      </button>
    </div>
  </div>
</template>
<script>
export default {
  name: "Navigation",
  methods: {
    createLand() {
      this.$router.push({
        name: "create_land",
      });
    },
    goToList() {
      this.$router.push({
        name: "list_lands",
      });
    },
  },
};
</script>
