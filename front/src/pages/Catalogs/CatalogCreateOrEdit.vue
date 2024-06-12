<template>
    <page-template :title="getPageTitle">
        <form @submit.prevent="submit()" class="w-full min-h-[100vh] flex flex-col justify-center items-center">
            <div class="w-8/12 py-6 flex flex-col justify-center items-center bg-gray-100 shadow-md border border-gray-600 rounded-md">
                <div class="w-full grid grid-cols-12 place-content-center place-items-center gap-y-10">
                    <div class="col-span-12 w-8/12 flex justify-start items-center text-left flex-wrap">
                        <label for="title" class="text-default-gray font-bold text-lg">Title <span class="text-xl text-red-600 font-bold">*</span></label>
                        <input v-model="catalog.title" type="text" name="title" id="title" placeholder="Type catalog's title..." class="default-input" required>
                    </div>

                    <div class="col-span-12 w-8/12 flex justify-start items-center text-left flex-wrap">
                        <label for="description" class="text-default-gray font-bold text-lg">Description <span class="text-xl text-red-600 font-bold">*</span></label>
                        <textarea v-model="catalog.description" name="description" id="description" placeholder="Type catalog's description..." class="default-input-textarea" cols="30" rows="5" required></textarea>
                    </div>

                    <div v-show="errors.length > 0" class="col-span-12 flex flex-col justify-start items-start text-left">
                        <span v-for="(error, index) in errors" :key="index" class="text-red-500 font-semibold">{{ error }}</span>
                    </div>

                    <div class="col-span-12 w-6/12 flex justify-center items-center text-left">
                        <button type="submit" class="w-full default-button">Save</button>
                    </div>
                </div>
            </div>
        </form>
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
    computed: {
        getPageTitle() {
            return this.catalog.id ? `Edit ${this.catalog.title}` : 'Create catalog';
        },
    },
    data() {
        return {
            headers: {
                'Content-Type': "multipart/form-data;"
            },
            errors: [],
            catalog: {
                id: '',
                title: '',
                description: '',
            },
        }
    },
    methods: {
         getCatalog() {
            axios.get(`http://localhost/api/catalogs/${this.$route.params.id}`)
                .then((response) => {
                    this.catalog.id = response.data.id;
                    this.catalog.title = response.data.title;
                    this.catalog.description = response.data.description;
                })
                .catch(error => console.log(error));
        },

        update() {
            axios.put(`http://localhost/api/catalogs/${this.catalog.id}`, {
                    "id": this.catalog.id,
                    "title": this.catalog.title,
                    "description": this.catalog.description,
                }, { headers: this.headers })
                .then(response => {
                    if(response) {
                        this.$router.push({ name: "catalogs" })
                    }

                    this.error.push("An error occurred trying to UPDATE Catalog. Please reload the page!");
                })
                .catch(error => console.log(error));
        },

        save() {
            axios.post("http://localhost/api/catalogs/", {
                "title": this.catalog.title,
                "description": this.catalog.description,
            }, { headers: this.headers })
            .then(response => {
                if(response) {
                    this.$router.push({ name: "catalogs" })
                }

                this.error.push("An error occurred trying to SAVE new Catalog. Please reload the page!");
            })
            .catch(error => console.log(error));
        },

        validation() {
            let validator = 0;
            this.errors = [];
            
            if(this.catalog.title === "" || !(this.catalog.title.length >= 3 && this.catalog.title.length <= 80)) {
                this.errors.push("The TITLE field are required and must be at least 3 characters and max of 80.");
                validator++;
            }

            if(this.catalog.description === "" || !(this.catalog.description.length >= 3 && this.catalog.description.length <= 255)) {
                this.errors.push("The DESCRIPTION field are required and must be at least 3 characters and max of 255.");
                validator++;
            }

            return validator == 0 ?? false;
        },

        submit() {
            if(this.validation()) {
                if(this.$route.params.id) {
                    this.update();
                }
                this.save();
            }
        },
    }
    
}

</script>