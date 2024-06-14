<template>
    <div class="col-span-12 w-11/12 justify-start items-center text-left flex-wrap gap-x-10 grid grid-cols-12 place-content-center place-items-center">
        <div class="col-span-12 w-11/12 flex justify-start items-center text-left flex-wrap gap-x-10">
            <h3 class="text-default-gray font-bold text-lg">Animals</h3>

            <span @click="showAnimal = !showAnimal" class="w-3/12 default-input-array-button">{{ getAnimalTitle }}</span>
        </div>

        <div v-if="showAnimal" class="col-span-12 w-11/12 flex justify-start items-center text-left flex-wrap">
            <div class="w-full grid grid-cols-12 place-content-center place-items-center gap-4 py-5">
                <div class="col-span-3 w-full flex justify-start items-center text-left flex-wrap">
                    <label for="animal_id" class="text-default-gray font-bold text-lg">Select Animals <span class="text-xl text-red-600 font-bold">*</span></label>
                    <select v-model="tempAnimal.id" class="default-input" name="animal_id" id="animal_id">
                        <option v-for="(animal, index) in animalsOptions" :key="index" :value="animal.id">{{ animal.name }}</option>
                    </select>
                </div>

                <div class="col-span-12 w-full flex flex-row justify-end items-end self-end text-left">
                    <span @click="addAnimal" class="w-2/12 default-input-array-button">+ animal</span>
                </div>
            </div>

            <input-array-component-template v-if="animals.length > 0" :headers="animalsHeaders">
                <tr v-for="(animal, index) in animals" :key="index" class="w-full border border-gray-400 divide-x-2 divide-gray-400">
                    <td class="lg:pl-3 pl-1 h-5 w-4/12">
                        {{ (index+1) }}
                    </td>
                    <td class="lg:pl-3 pl-1 h-5 w-6/12">
                        {{ animal.name }}
                    </td>
                    <td class="lg:pl-3 pl-1 h-5 w-6/12">
                        {{ animal.specie }}
                    </td>
                    <td class="lg:pl-3 pl-1 h-5 w-6/12">
                        <span @click="removeAnimal(animal)" class="hover:underline text-red-500 uppercase">Remove</span>
                    </td>
                </tr>  
            </input-array-component-template>

            <span v-else class="text-lg text-red-500">The catalog does not have animals added.</span>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import InputArrayComponentTemplate from './Utils/InputArrayComponentTemplate.vue'

export default {
    beforeMount() {
        this.getAnimalsOptions();
    },

    components: {
        InputArrayComponentTemplate
    },
    computed: {
        getAnimalTitle() {
            return this.showAnimal ? 'Clear animals' : 'Show animals';
        },
    },
    watch: {
        showAnimal(oldVal, newVal) {
            if((oldVal == false && newVal == true) && !this.$route.params.id) {
                this.tempAnimal = {
                    animal_id: ''
                };

                this.$emit('update-animal', []);
            }
        },
    },
    props: {
        animals: {
            type: Array,
            required: true,
            default: () => []
        }
    },
    data() {
        return {
            showAnimal: false,
            animalsOptions: [],
            animalsHeaders: [
                "Index",
                "Name",
                "Specie",
                "Delete"
            ],
            tempAnimal: {
                id: '',
                name: '',
                specie: '',
            },
        }
    },
    methods: {
        async getAnimalsOptions() {
            await axios.get(`http://localhost/api/animals`)
                .then((response) => {
                    this.animalsOptions = response.data
                })
                .catch(error => console.log(error));
        },

        addAnimal() {
            if(this.tempAnimal.id !== '') {
                this.animalsOptions.forEach(el => {
                    if(el.id === this.tempAnimal.id) {
                        this.tempAnimal.name = el.name;
                        this.tempAnimal.specie = el.specie;
                    }
                });

                const newAnimal = {
                    id: this.tempAnimal.id,
                    name: this.tempAnimal.name,
                    specie: this.tempAnimal.specie,
                };

                const newAnimals = [...this.animals, newAnimal];

                this.tempAnimal = {
                    id: '',
                    name: '',
                    specie: '',
                };

                this.$emit('update-animal', newAnimals);
            }
        },

        removeAnimal(object) {
            const newAnimals = this.animals.filter(el => el.id !== object.id);
            
            this.$emit('update-animal', newAnimals);
        },
    }
}
</script>
