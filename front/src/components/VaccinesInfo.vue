<template>
    <div class="col-span-12 w-11/12 justify-start items-center text-left flex-wrap gap-x-10 grid grid-cols-12 place-content-center place-items-center">
        <div class="col-span-12 w-11/12 flex justify-start items-center text-left flex-wrap gap-x-10">
            <h3 class="text-default-gray font-bold text-lg">Vaccines</h3>

            <span @click="showVaccines = !showVaccines" class="w-3/12 default-input-array-button">{{ getVaccinesTitle }}</span>

            <span class="w-full text-lg">Total: {{ vaccines.length }}</span>
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

            <input-array-component-template v-if="vaccines.length > 0" :headers="vaccinesHeaders">
                <tr v-for="(vaccine, index) in vaccines" :key="index" class="w-full border border-gray-400 divide-x-2 divide-gray-400">
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
                        <span @click="removeVaccine(vaccine)" class="hover:underline text-red-500 uppercase">Remove</span>
                    </td>
                </tr>  
            </input-array-component-template>

            <span v-else class="text-lg text-red-500">The animal does not have vaccines added.</span>
        </div>
    </div>
</template>

<script>
import InputArrayComponentTemplate from './Utils/InputArrayComponentTemplate.vue'

export default {
    components: {
        InputArrayComponentTemplate
    },
    computed: {
        getVaccinesTitle() {
            return this.showVaccines ? 'Clear Vaccines' : 'Show Vaccines';
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

                this.$emit('update-vaccines', []);
            }
        },
    },
    props: {
        vaccines: {
            type: Array,
            required: true,
            default: () => []
        }
    },
    data() {
        return {
            showVaccines: false,
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
        }
    },
    methods: {
        addVaccine() {
            if(this.tempVaccine.title !== '' && this.tempVaccine.date !== '') {
                const newVaccine = {
                    title: this.tempVaccine.title,
                    date: this.tempVaccine.date,
                    next: this.tempVaccine.next,
                    description: this.tempVaccine.description,
                };

                const newVaccines = [...this.vaccines, newVaccine];

                this.tempVaccine = {
                    title: '',
                    date: '',
                    next: '',
                    description: '',
                };

                this.$emit('update-vaccines', newVaccines);
            }
        },

        removeVaccine(object) {
            const newVaccines = this.vaccines.filter(el => el.title !== object.title);
            
            this.$emit('update-vaccines', newVaccines);
        },
    }
}
</script>
