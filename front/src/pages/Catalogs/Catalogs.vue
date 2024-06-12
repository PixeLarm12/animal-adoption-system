<template>
    <page-template title="Catalogs">

        <div class="w-8/12 flex flex-row justify-start items-center gap-x-4">
            <router-link to="/catalogs/create" class="default-button mb-5">Create new Catalog</router-link>
            <button @click="showTable = !showTable" class="default-button mb-5">{{ getShowButtonTitle }}</button>
        </div>
        
        <div v-show="!showTable && catalogs.length > 0" class="w-8/12 flex flex-row justify-center items-center gap-4 flex-wrap">
            <router-link v-for="catalog in catalogs" :key="catalog.id" :to="'/catalogs/edit/' + catalog.id" class="bg-catalog-card">
                <h2 class="text-bold text-xl">{{ catalog.title }}</h2>
            </router-link>
        </div>

        <div v-show="showTable && catalogs.length > 0" class="w-8/12 flex flex-row justify-center items-center gap-4">
            <table-template :headers="tableHeaders">
                <tr v-for="catalog in catalogs" :key="catalog.id" class="w-full border border-black divide-x-2 divide-black">
                    <td class="lg:pl-3 pl-1 h-10 w-4/12">
                        {{ catalog.title }}
                    </td>
                    <td class="lg:pl-3 pl-1 h-10 w-6/12">
                        {{ catalog.description }}
                    </td>
                    <td class="lg:pl-3 pl-1 h-10 w-2/12">
                        <div class="w-full flex justify-start lg:gap-6 gap-1">
                            <router-link :to="'/catalogs/edit/' + catalog.id" class="hover:underline uppercase">Edit</router-link>
                            <span @click="remove(catalog.id)" class="hover:underline uppercase">Delete</span>
                        </div>
                    </td>
                </tr>  
            </table-template>
        </div>

        <div v-if="catalogs.length <= 0" class="w-8/12 flex justify-center items-center">
            <h3 class="text-xl text-red-600 font-bold">Sorry, but we don't have any active catalogs to show...</h3>
        </div>
    </page-template>
</template>

<script>
import axios from 'axios';
import PageTemplate from "../../components/PageTemplate.vue";
import TableTemplate from '../../components/Utils/TableTemplate.vue';

export default {
    beforeMount() {
        axios.get('http://localhost/api/catalogs')
            .then(response => this.catalogs = response.data)
            .catch(error => console.log(`Error: ${error}`));
    },

    components: {
        PageTemplate,
        TableTemplate
    },

    computed: {
        getShowButtonTitle() {
            return this.showTable ? "Card view" : "Table view"; 
        }
    },

    data() {
        return {
            showTable: false,
            catalogs: [],
            tableHeaders: [
                "Title",
                "Description",
            ]
        }
    },

    methods: {
        remove(id) {
            axios.delete(`http://localhost/api/catalogs/${id}`)
                .then((response) => {
                    if(response) {
                        this.$router.go(this.$router.currentRoute);
                    }
                })
                .catch(error => console.log(`Error: ${error}`));
        }
    }
}
</script>
