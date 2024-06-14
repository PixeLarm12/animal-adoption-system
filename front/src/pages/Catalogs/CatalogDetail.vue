<template>
    <page-template title="View Catalog 1">
        <div class="w-8/12 flex flex-row justify-center items-center gap-4 flex-wrap">
            <div v-for="animal in catalog.animals" :key="animal.id" class="bg-catalog-card">
                <h2>{{ animal.name }}</h2>
                <h2>{{ animal.specie }}</h2>
            </div>
        </div>
    </page-template>
</template>

<script>
import axios from 'axios';
import PageTemplate from "../../components/PageTemplate.vue"

export default {
    beforeMount() {
        if(this.$route.params.id) {
            this.getCatalog();
        }
    },

    components: {
        PageTemplate
    },

    data() {
        return {
            headers: {
                'Content-Type': "application/json;",
                'Accept': "application/json;"
            },
            errors: [],
            catalog: {
                id: '',
                title: '',
                description: '',
                animals: []
            },
        }
    },
    
    methods: {
        async getCatalog() {
            await axios.get(`http://localhost/api/catalogs/${this.$route.params.id}`)
                .then((response) => {
                    this.catalog.id = response.data.id;
                    this.catalog.title = response.data.title;
                    this.catalog.description = response.data.description;
                    this.catalog.animals = response.data.animals;
                })
                .catch(error => console.log(error));
        },
    }
    
}

</script>
