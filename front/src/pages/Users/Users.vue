<template>
    <page-template title="Users">

        <div class="w-8/12 flex flex-row justify-start items-center gap-x-4">
            <router-link to="/users/create" class="default-button mb-5">Create new User</router-link>
        </div>

        <div v-show="users.length > 0" class="w-8/12 flex flex-row justify-center items-center gap-4">
            <table-template :headers="tableHeaders">
                <tr v-for="user in users" :key="user.id" class="w-full border border-black divide-x-2 divide-black">
                    <td class="lg:pl-3 pl-1 h-10 w-4/12">
                        {{ user.name }}
                    </td>
                    <td class="lg:pl-3 pl-1 h-10 w-6/12">
                        {{ user.cpf }}
                    </td>
                    <td class="lg:pl-3 pl-1 h-10 w-6/12">
                        {{ user.email }}
                    </td>
                    <td class="lg:pl-3 pl-1 h-10 w-2/12">
                        <div class="w-full flex justify-start lg:gap-6 gap-1">
                            <span @click="remove(user.id)" class="hover:underline uppercase">Delete</span>
                        </div>
                    </td>
                </tr>  
            </table-template>
        </div>

        <div v-if="users.length <= 0" class="w-8/12 flex justify-center items-center">
            <h3 class="text-xl text-red-600 font-bold">Sorry, but we don't have any active users to show...</h3>
        </div>
    </page-template>
</template>

<script>
import axios from 'axios';
import PageTemplate from "../../components/PageTemplate.vue";
import TableTemplate from '../../components/Utils/TableTemplate.vue';

export default {
    beforeMount() {
        axios.get('http://localhost/api/users')
            .then(response => this.users = response.data)
            .catch(error => console.log(`Error: ${error}`));
    },

    components: {
        PageTemplate,
        TableTemplate
    },

    data() {
        return {
            users: [],
            tableHeaders: [
                "Name",
                "CPF",
                "Email",
            ]
        }
    },

    methods: {
        remove(id) {
            axios.delete(`http://localhost/api/users/${id}`)
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
