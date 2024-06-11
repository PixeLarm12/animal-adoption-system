<template>
    <page-template>
        <div class="w-screen flex flex-col justify-center items-center">
            <div class="w-10/12 h-full flex flex-col justify-center items-center">
                <router-link to="/animals/create" class="default-button self-start mb-5">Create new Animal</router-link>

                <table-template :headers="tableHeaders">
                    <tr v-for="animal in animals" :key="animal.id" class="w-full border border-black divide-x-2 divide-black">
                        <td class="lg:pl-3 pl-1 h-10 w-4/12">
                            {{ animal.name }}
                        </td>
                        <td class="lg:pl-3 pl-1 h-10 w-2/12">
                            {{ animal.specie }}
                        </td>
                        <td class="lg:pl-3 pl-1 h-10 w-1/12">
                            {{ animal.sex }}
                        </td>
                        <td class="lg:pl-3 pl-1 h-10 w-2/12">
                            {{ animal.adoption_status }}
                        </td>
                        <td class="lg:pl-3 pl-1 h-10 w-1/12">
                            <div class="w-full flex justify-start lg:gap-6 gap-1">
                                <router-link :to="'/animals/edit/' + animal.id" class="hover:underline uppercase">Edit</router-link>
                                <span @click="remove(animal.id)" class="hover:underline uppercase">Delete</span>
                            </div>
                        </td>
                    </tr>  
                </table-template>
            </div>
        </div>
    </page-template>
</template>

<script>
import PageTemplate from "../../components/PageTemplate.vue"
import TableTemplate from '../../components/Utils/TableTemplate.vue'

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
