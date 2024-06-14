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

                    <!-- VACCINES -->
                    <div class="col-span-12 w-11/12 flex justify-start items-center text-left flex-wrap gap-x-10">
                        <h3 class="text-default-gray font-bold text-lg">Vaccines</h3>

                        <span @click="showVaccines = !showVaccines" class="w-3/12 default-input-array-button">{{ getVaccinesTitle }}</span>
                    </div>

                    <div v-if="showVaccines" class="col-span-12 w-11/12 flex justify-start items-center text-left flex-wrap">
                        <div class="w-full grid grid-cols-12 place-content-center place-items-center gap-4 py-5">
                            <div class="col-span-12 lg:col-span-6 w-full flex justify-start items-center text-left flex-wrap">
                                <label for="vaccine-title" class="text-default-gray font-bold text-lg">Title <span class="text-xl text-red-600 font-bold">*</span></label>
                                <input v-model="tempVaccine.title" type="vaccine-title" name="vaccine-title" id="vaccine-title" placeholder="Type vaccine's title..." class="default-input">
                            </div>

                            <div class="col-span-12 lg:col-span-3 w-full flex justify-start items-center text-left flex-wrap">
                                <label for="vaccine-date" class="text-default-gray font-bold text-lg">First dose <span class="text-xl text-red-600 font-bold">*</span></label>
                                <input v-model="tempVaccine.date" type="date" name="vaccine-date" id="vaccine-date" class="default-input">
                            </div>

                            <div class="col-span-12 lg:col-span-3 w-full flex justify-start items-center text-left flex-wrap">
                                <label for="vaccine-next" class="text-default-gray font-bold text-lg">Second dose</label>
                                <input v-model="tempVaccine.next" type="date" name="vaccine-next" id="vaccine-next" class="default-input">
                            </div>

                            <div class="col-span-12 w-full flex justify-start items-center text-left flex-wrap">
                                <label for="vaccine-description" class="text-default-gray font-bold text-lg">Description</label>
                                <textarea v-model="tempVaccine.description" name="vaccine-description" id="vaccine-description" placeholder="Type vaccine's description..." class="default-input resize-none"></textarea>
                            </div>

                            <div class="col-span-12 w-full flex flex-row justify-end items-end self-end text-left">
                                <span @click="addVaccine" class="w-2/12 default-input-array-button">+ vaccine</span>
                            </div>
                        </div>

                        <input-array-component-template :headers="vaccinesHeaders">
                            <tr v-for="(vaccine, index) in animal.vaccines" :key="index" class="w-full border border-gray-400 divide-x-2 divide-gray-400">
                                <td class="lg:pl-3 pl-1 h-5 w-4/12">
                                    {{ (index+1) }}
                                </td>
                                <td class="lg:pl-3 pl-1 h-5 w-6/12">
                                    {{ vaccine.title }}
                                </td>
                                <td class="lg:pl-3 pl-1 h-5 w-6/12">
                                    {{ vaccine.date }}
                                </td>
                                <td class="lg:pl-3 pl-1 h-5 w-6/12">
                                    <span @click="removeVaccine(index)" class="hover:underline text-red-500 uppercase">Remove</span>
                                </td>
                            </tr>  
                        </input-array-component-template>
                    </div>
                    <!-- END VACCINES -->

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
import InputArrayComponentTemplate from '../../components/Utils/InputArrayComponentTemplate.vue';

export default {
    beforeMount() {
        if(this.$route.params.id) {
            this.getAnimal();
        }

        this.getFormSelectOptions();
    },

    components: {
        PageTemplate,
        InputArrayComponentTemplate
    },

    computed: {
        getPageTitle() {
            return this.animal.id ? `Edit ${this.animal.name}` : 'Create Animal';
        },
        
        getVaccinesTitle() {
            return this.showVaccines ? 'Hide Vaccines' : 'Show Vaccines';
        },
    },

    watch: {
        showVaccines(oldVal, newVal) {
            if((oldVal == false && newVal == true) && !this.$route.params.id) {
                this.tempVaccine = {
                    title: '',
                    date: '',
                    next: '',
                    description: '',
                };

                this.animal.vaccines = [];
            }
        }
    },

    data() {
        return {
            headers: {
                'Content-Type': "application/json;",
                'Accept': "application/json;"
            },
            showVaccines: false,
            errors: [],
            vaccinesHeaders: [
                "Index",
                "Title",
                "Date",
                "Delete"
            ],
            tempVaccine: {
                title: '',
                date: '',
                next: '',
                description: '',
            },
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

        addVaccine() {
            if(this.tempVaccine.title !== '', this.tempVaccine.date !== '') {
                this.animal.vaccines.push({
                    title: this.tempVaccine.title,
                    date: this.tempVaccine.date,
                    next: this.tempVaccine.next,
                    description: this.tempVaccine.description,
                });

                this.tempVaccine = {
                    title: '',
                    date: '',
                    next: '',
                    description: '',
                };
            }
        },

        removeVaccine(position) {
            this.animal.vaccines.splice(position, 1);
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
