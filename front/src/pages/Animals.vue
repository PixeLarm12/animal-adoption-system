<template>
    <page-template>
        <div class="w-screen flex flex-col justify-center items-center">
            <div class="w-screen min-h-[80vh] flex flex-col justify-center items-center">
                <div class="w-10/12 h-full flex flex-col justify-center items-center">
                    <router-link to="/animals/create" class="default-button">Create new Animal</router-link>
                    
                    <table-template :headers="tableHeaders">
                        <tr v-for="animal in animals" :key="animal.id" class="text-default-gray bg-gray-100 border border-default-gray">
                            <td class="border border-default-gray w-4/12">
                                {{ animal.name }}
                            </td>
                            <td class="border border-default-gray w-2/12">
                                {{ animal.specie }}
                            </td>
                            <td class="border border-default-gray w-1/12">
                                {{ animal.sex }}
                            </td>
                            <td class="border border-default-gray w-3/12">
                                {{ animal.adoption_status }}
                            </td>
                            <td class="border border-default-gray flex justify-around w-2/12">
                                <router-link :to="'/animals/edit/' + animal.id" class="hover:underline uppercase">Edit</router-link>
                                <span @click="remove(animal.id)" class="hover:underline uppercase">Delete</span>
                            </td>
                        </tr>  
                    </table-template>
                </div>
            </div>
        </div>
    </page-template>
</template>

<script>
import PageTemplate from "../components/PageTemplate.vue"
import TableTemplate from '../components/Utils/TableTemplate.vue'

export default {
    components: {
        PageTemplate,
        TableTemplate
    },
    methods: {
        remove(id) {
            console.log(`This item ${id} needs to be removed!!!`);
        }
    },
    data() {
        return {
            animals: [
                {
                    id: 1,
                    name: "Doguinho",
                    specie: "dog",
                    sex: "m",
                    adoption_status: "processing",
                },
                {
                    id: 3,
                    name: "Car",
                    specie: "cat",
                    sex: "f",
                    adoption_status: "accepted",
                },
            ],
            tableHeaders: [
                "Name",
                "Specie",
                "Sex",
                "Status",
            ]
        }
    }
}
</script>
