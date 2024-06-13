<template>
    <page-template :title="getPageTitle">
        <form @submit.prevent="submit()" class="w-full min-h-[50vh] flex flex-col justify-center items-center">
            <div class="w-8/12 py-6 flex flex-col justify-center items-center bg-gray-100 shadow-md border border-gray-600 rounded-md">
                <div class="w-full grid grid-cols-12 place-content-center place-items-center gap-y-10">
                    <div class="col-span-12 lg:col-span-4 w-8/12 flex justify-start items-center text-left flex-wrap">
                        <label for="name" class="text-default-gray font-bold text-lg">Name <span class="text-xl text-red-600 font-bold">*</span></label>
                        <input v-model="animal.name" type="name" name="name" id="name" placeholder="Type animal's name..." class="default-input" required>
                    </div>
                    
                    <div class="col-span-12 lg:col-span-4 w-8/12 flex justify-start items-center text-left flex-wrap">
                        <label for="specie" class="text-default-gray font-bold text-lg">Select Specie <span class="text-xl text-red-600 font-bold">*</span></label>
                        <select v-model="animal.specie" class="default-input" name="specie" id="specie" required>
                            <option value="" selected>Select animal's specie...</option>
                            <option v-for="(specie, index) in speciesOptions" :key="index" :value="specie.key">{{ specie.label }}</option>
                        </select>
                    </div>

                    <div class="col-span-12 lg:col-span-4 w-8/12 flex justify-start items-center text-left flex-wrap">
                        <label for="sex" class="text-default-gray font-bold text-lg">Select Sex <span class="text-xl text-red-600 font-bold">*</span></label>
                        <select v-model="animal.sex" class="default-input" name="sex" id="sex" required>
                            <option value="m" selected>Male</option>
                            <option value="f">Female</option>
                        </select>
                    </div>

                    <div class="col-span-12 lg:col-span-6 w-8/12 flex justify-start items-center text-left flex-wrap">
                        <label for="entry-date" class="text-default-gray font-bold text-lg">Select Entry Date <span class="text-xl text-red-600 font-bold">*</span></label>
                        <input v-model="animal.entry_date" type="date" name="entry-date" id="entry-date" class="default-input" required>
                    </div>

                    <div class="col-span-12 lg:col-span-6 w-8/12 flex justify-start items-center text-left flex-wrap">
                        <label for="birth-date" class="text-default-gray font-bold text-lg">Select Birth Date</label>
                        <input v-model="animal.birth_date" type="date" name="birth-date" id="birth-date" class="default-input">
                    </div>

                    <div class="col-span-12 w-8/12 flex justify-start items-center text-left flex-wrap">
                        <label for="description" class="text-default-gray font-bold text-lg">Description <span class="text-xl text-red-600 font-bold">*</span></label>
                        <textarea v-model="animal.description" name="description" id="description" placeholder="Type animal's description..." class="default-input resize-none" required></textarea>
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
            this.getAnimal();
        }

        this.getFormSelectOptions();
    },

    components: {
        PageTemplate
    },

    computed: {
        getPageTitle() {
            return this.animal.id ? `Edit ${this.animal.name}` : 'Create Animal';
        },
    },

    data() {
        return {
            headers: {
                'Content-Type': "application/json;",
                'Accept': "application/json;"
            },
            errors: [],
            animal: {
                id: '',
                name: '',
                specie: '',
                sex: '',
                description: '',
                entry_date: '',
                birth_date: '',
                vaccines: [],
                medical_informations: [],
            },
            speciesOptions: [],
        }
    },

    methods: {
        async getAnimal() {
            await axios.get(`http://localhost/api/animals/${this.$route.params.id}`)
                .then((response) => {
                    this.animal.id = response.data.id;
                    this.animal.name = response.data.name;
                    this.animal.specie = response.data.specie;
                    this.animal.sex = response.data.sex;
                    this.animal.description = response.data.description;
                    this.animal.entry_date = response.data.entry_date;
                    this.animal.birth_date = response.data.birth_date;
                    this.animal.vaccines = response.data.vaccines;
                    this.animal.medical_informations = response.data.medical_informations;
                })
                .catch(error => console.log(error));
        },

        async getFormSelectOptions() {
            await axios.get(`http://localhost/api/animals/get-form-select-options`)
                .then((response) => {
                    console.log(response.data);
                    this.speciesOptions = response.data['speciesOptions']
                })
                .catch(error => console.log(error));
        },

        async update() {
            await axios.put(`http://localhost/api/animals/${this.animal.id}`, {
                    "id": this.animal.id,
                    "name": this.animal.name,
                    "specie": this.animal.specie,
                    "sex": this.animal.sex,
                    "description": this.animal.description,
                    "entry_date": this.animal.entry_date,
                    "birth_date": this.animal.birth_date,
                    "vaccines": this.animal.vaccines,
                    "medical_informations": this.animal.medical_informations,
                }, { headers: this.headers })
                .then(response => {
                    if(response) {
                        this.$router.push({ name: "animals" })
                    }

                    this.error.push("An error occurred trying to UPDATE Animal. Please reload the page!");
                })
                .catch(error => console.log(error));
        },

        async save() {
            await axios.post("http://localhost/api/animals/", {
                "name": this.animal.name,
                "specie": this.animal.specie,
                "sex": this.animal.sex,
                "description": this.animal.description,
                "entry_date": this.animal.entry_date,
                "birth_date": this.animal.birth_date,
                "vaccines": this.animal.vaccines,
                "medical_informations": this.animal.medical_informations,
            }, { headers: this.headers })
            .then(response => {
                if(response) {
                    this.$router.push({ name: "animals" })
                }

                this.error.push("An error occurred trying to SAVE new Animal. Please reload the page!");
            })
            .catch(error => console.log(error));
        },

        validation() {
            let validator = 0;
            this.errors = [];
            
            if(this.animal.name === "" || !(this.animal.name.length >= 3 && this.animal.name.length <= 80)) {
                this.errors.push("The TITLE field are required and must be at least 3 characters and max of 80.");
                validator++;
            }

            if(this.animal.specie === "") {
                this.errors.push("The SPECIE field are required.");
                validator++;
            }

            if(this.animal.sex === "") {
                this.errors.push("The SEX field are required.");
                validator++;
            }

            if(this.animal.entry_date === "") {
                this.errors.push("The ENTRY DATE field are required.");
                validator++;
            }

            if(this.animal.description === "" || !(this.animal.description.length >= 3 && this.animal.description.length <= 255)) {
                this.errors.push("The DESCRIPTION field are required and must be at least 3 characters and max of 255.");
                validator++;
            }

            return validator == 0 ?? false;
        },

        submit() {
            if(this.validation()) {
                if(this.$route.params.id) {
                    this.update();
                } else {
                    this.save();
                }
            }
        },
    }
}

</script>
