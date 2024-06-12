<template>
    <page-template>
        <div class="w-screen flex flex-col justify-center items-center">
            <div class="w-10/12 h-full flex flex-col justify-center items-center">
                <router-link to="/adoptions/create" class="default-button self-start mb-5">Start new Adoption</router-link>

                <table-template :headers="tableHeaders">
                    <tr v-for="adoption in adoptions" :key="adoption.id" class="w-full border border-black divide-x-2 divide-black">
                        <td class="lg:pl-3 pl-1 h-10 w-4/12">
                            {{ adoption.animal }}
                        </td>
                        <td class="lg:pl-3 pl-1 h-10 w-2/12">
                            {{ adoption.person }}
                        </td>
                        <td class="lg:pl-3 pl-1 h-10 w-1/12">
                            {{ adoption.status }}
                        </td>
                        <td class="lg:pl-3 pl-1 h-10 w-2/12">
                            {{ adoption.adoption_date }}
                        </td>
                        <td class="lg:pl-3 pl-1 h-10 w-1/12">
                            <div class="w-full flex justify-start lg:gap-6 gap-1">
                                <router-link :to="'/adoptions/edit/' + adoption.id" class="hover:underline uppercase">Edit</router-link>
                                <span @click="remove(adoption.id)" class="hover:underline uppercase">Delete</span>
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
            adoptions: [
                {
                    id: 1,
                    animal: 'Doguinho',
                    person: 'Usuario 1',
                    status: 'Processing',
                    adoption_date: '2024-06-10',
                    observation: ''  
                },
                {
                    id: 2,
                    animal: 'Doguinho',
                    person: 'Usuario 2',
                    status: 'Accepted',
                    adoption_date: '2024-06-10',
                    observation: ''  
                },
            ],
            tableHeaders: [
                "Animal",
                "Person",
                "Status",
                "Date",
            ]
        }
    }
}
</script>
