<template>
    <page-template>
        <div class="w-screen flex flex-col justify-center items-center">
            <div class="w-10/12 h-full flex flex-col justify-center items-center">
                <router-link to="/adoptions/create" class="default-button self-start mb-5">Start new Adoption</router-link>

                <table-template v-if="adoptions.length > 0" :headers="tableHeaders">
                    <tr v-for="adoption in adoptions" :key="adoption.id" class="w-full border border-black divide-x-2 divide-black">
                        <td class="lg:pl-3 pl-1 h-10 w-4/12">
                            {{ adoption.animal_name_append }}
                        </td>
                        <td class="lg:pl-3 pl-1 h-10 w-2/12">
                            {{ adoption.person_name_append }}
                        </td>
                        <td class="lg:pl-3 pl-1 h-10 w-1/12 font-bold" :class="getStatusColor(adoption.status)">
                            {{ adoption.status_formatted }}
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

                <div v-else class="w-8/12 flex justify-center items-center">
                    <h3 class="text-xl text-red-600 font-bold">Sorry, but we don't have any active adoptions to show...</h3>
                </div>
            </div>
        </div>
    </page-template>
</template>

<script>
import axios from 'axios';
import PageTemplate from "../../components/PageTemplate.vue"
import TableTemplate from '../../components/Utils/TableTemplate.vue'

export default {
    beforeMount() {
        axios.get('http://localhost/api/adoptions')
            .then(response => this.adoptions = response.data)
            .catch(error => console.log(`Error: ${error}`));
    },

    components: {
        PageTemplate,
        TableTemplate
    },

    methods: {
        remove(id) {
            axios.delete(`http://localhost/api/adoptions/${id}`)
                .then((response) => {
                    if(response) {
                        this.$router.go(this.$router.currentRoute);
                    }
                })
                .catch(error => console.log(`Error: ${error}`));
        },
        getStatusColor(status) {
            if(status === 'not_started'){
                return 'text-defaut-gray';
            }
            if(status === 'processing'){
                return 'text-yellow-500';
            }
            if(status === 'accepted'){
                return 'text-green-500';
            }
            if(status === 'not_accepted'){
                return 'text-red-500';
            }
        }
    },

    data() {
        return {
            adoptions: [],
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
