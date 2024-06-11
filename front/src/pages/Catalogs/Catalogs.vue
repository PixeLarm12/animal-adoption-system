<template>
    <page-template title="Catalogs">

        <div class="w-8/12 flex flex-row justify-start items-center gap-x-4">
            <router-link to="/catalogs/create" class="default-button mb-5">Create new Catalog</router-link>
            <button @click="showTable = !showTable" class="default-button mb-5">{{ getShowButtonTitle }}</button>
        </div>
        
        <div v-show="!showTable" class="w-8/12 flex flex-row justify-center items-center gap-4 flex-wrap">
            <router-link to="/catalogs/detail/1" class="bg-catalog-card">
                <h2>See catalog 1</h2>
            </router-link>
        </div>

        <div v-show="showTable" class="w-8/12 flex flex-row justify-center items-center gap-4 flex-wrap">
            <table-template :headers="tableHeaders">
                <tr v-for="catalog in catalogs" :key="catalog.id" class="w-full border border-black divide-x-2 divide-black">
                    <td class="lg:pl-3 pl-1 h-10 w-4/12">
                        {{ catalog.title }}
                    </td>
                    <td class="lg:pl-3 pl-1 h-10 w-2/12">
                        {{ catalog.description }}
                    </td>
                    <td class="lg:pl-3 pl-1 h-10 w-1/12">
                        <div class="w-full flex justify-start lg:gap-6 gap-1">
                            <router-link :to="'/catalogs/edit/' + catalog.id" class="hover:underline uppercase">Edit</router-link>
                            <span @click="remove(catalog.id)" class="hover:underline uppercase">Delete</span>
                        </div>
                    </td>
                </tr>  
            </table-template>
        </div>
    </page-template>
</template>

<script>
import PageTemplate from "../../components/PageTemplate.vue"
import TableTemplate from '../../components/Utils/TableTemplate.vue';

export default {
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
            catalogs: [
                {
                    id: 1,
                    title: "Catalog 1",
                    description: "New catalog description 1",
                },
                {
                    id: 2,
                    title: "Catalog 2",
                    description: "New catalog description 2",
                },
            ],
            tableHeaders: [
                "Title",
                "Description",
            ]
        }
    },
    methods: {
        remove(id) {
            console.log(`This id: ${id} needs to be removed!!!`);
        }
    }
}
</script>
