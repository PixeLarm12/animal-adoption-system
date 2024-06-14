<template>
    <div class="col-span-12 w-11/12 justify-start items-center text-left flex-wrap gap-x-10 grid grid-cols-12 place-content-center place-items-center">
        <div class="col-span-12 w-11/12 flex justify-start items-center text-left flex-wrap gap-x-10">
            <h3 class="text-default-gray font-bold text-lg">Medical Informations</h3>

            <span @click="showMedicalInformation = !showMedicalInformation" class="w-3/12 default-input-array-button">{{ getMedicalInformationTitle }}</span>
        </div>

        <div v-if="showMedicalInformation" class="col-span-12 w-11/12 flex justify-start items-center text-left flex-wrap">
            <div class="w-full grid grid-cols-12 place-content-center place-items-center gap-4 py-5">
                <div class="col-span-12 w-full flex justify-start items-center text-left flex-wrap">
                    <label for="medical-info-description" class="text-default-gray font-bold text-lg">Description <span class="text-xl text-red-600 font-bold">*</span></label>
                    <textarea v-model="tempMedicalInformation.description" name="medical-info-description" id="medical-info-description" placeholder="Type medical information description..." class="default-input resize-none"></textarea>
                </div>

                <div class="col-span-12 w-full flex flex-row justify-end items-end self-end text-left">
                    <span @click="addMedicalInformation" class="w-2/12 default-input-array-button">+ med. info.</span>
                </div>
            </div>

            <input-array-component-template v-if="medicalInformations.length > 0" :headers="medicalInformationHeaders">
                <tr v-for="(info, index) in medicalInformations" :key="index" class="w-full border border-gray-400 divide-x-2 divide-gray-400">
                    <td class="lg:pl-3 pl-1 h-5 w-4/12">
                        {{ (index+1) }}
                    </td>
                    <td class="lg:pl-3 pl-1 h-5 w-6/12">
                        {{ info.description }}
                    </td>
                    <td class="lg:pl-3 pl-1 h-5 w-6/12">
                        <span @click="removeMedicalInformation(info)" class="hover:underline text-red-500 uppercase">Remove</span>
                    </td>
                </tr>  
            </input-array-component-template>

            <span v-else class="text-lg text-red-500">The animal does not have medical informations added.</span>
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
        getMedicalInformationTitle() {
            return this.showMedicalInformation ? 'Clear Medical Informations' : 'Show Medical Informations';
        },
    },
    watch: {
        showMedicalInformation(oldVal, newVal) {
            if((oldVal == false && newVal == true) && !this.$route.params.id) {
                this.tempMedicalInformation = {
                    description: '',
                };

                this.$emit('update-medical-information', []);
            }
        },
    },
    props: {
        medicalInformations: {
            type: Array,
            required: true,
            default: () => []
        }
    },
    data() {
        return {
            showMedicalInformation: false,
            medicalInformationHeaders: [
                "Index",
                "Description",
                "Delete"
            ],
            tempMedicalInformation: {
                description: '',
            },
        }
    },
    methods: {
        addMedicalInformation() {
            if(this.tempMedicalInformation.description !== '') {
                const newMedicalInfo = {
                    description: this.tempMedicalInformation.description,
                };

                const newMedicalInfos = [...this.medicalInformations, newMedicalInfo];

                this.tempMedicalInformation = {
                    description: '',
                };

                this.$emit('update-medical-information', newMedicalInfos);
            }
        },

        removeMedicalInformation(object) {
            const newMedicalInfos = this.medicalInformations.filter(el => el.description !== object.description);
            
            this.$emit('update-medical-information', newMedicalInfos);
        },
    }
}
</script>
