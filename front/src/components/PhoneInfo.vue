<template>
    <div class="col-span-12 w-11/12 justify-start items-center text-left flex-wrap gap-x-10 grid grid-cols-12 place-content-center place-items-center">
        <div class="col-span-12 w-11/12 flex justify-start items-center text-left flex-wrap gap-x-10">
            <h3 class="text-default-gray font-bold text-lg">Phones</h3>

            <span @click="showPhone = !showPhone" class="w-3/12 default-input-array-button">{{ getPhoneTitle }}</span>
        </div>

        <div v-if="showPhone" class="col-span-12 w-11/12 flex justify-start items-center text-left flex-wrap">
            <div class="w-full grid grid-cols-12 place-content-center place-items-center gap-4 py-5">
                <div class="col-span-3 w-full flex justify-start items-center text-left flex-wrap">
                    <label for="phone-area" class="text-default-gray font-bold text-lg">Area <span class="text-xl text-red-600 font-bold">*</span></label>
                    <input v-model="tempPhone.area" type="phone-area" name="phone-area" id="phone-area" placeholder="(00)" class="default-input">
                </div>

                <div class="col-span-9 w-full flex justify-start items-center text-left flex-wrap">
                    <label for="phone-phone" class="text-default-gray font-bold text-lg">Phone <span class="text-xl text-red-600 font-bold">*</span></label>
                    <input v-model="tempPhone.phone" type="phone-phone" name="phone-phone" id="phone-phone" placeholder="0 0000-0000" class="default-input">
                </div>

                <div class="col-span-12 w-full flex flex-row justify-end items-end self-end text-left">
                    <span @click="addPhone" class="w-2/12 default-input-array-button">+ phone</span>
                </div>
            </div>

            <input-array-component-template v-if="phones.length > 0" :headers="phoneHeaders">
                <tr v-for="(phone, index) in phones" :key="index" class="w-full border border-gray-400 divide-x-2 divide-gray-400">
                    <td class="lg:pl-3 pl-1 h-5 w-4/12">
                        {{ (index+1) }}
                    </td>
                    <td class="lg:pl-3 pl-1 h-5 w-6/12">
                        {{ phone.area }} - {{ phone.phone }}
                    </td>
                    <td class="lg:pl-3 pl-1 h-5 w-6/12">
                        <span @click="removePhone(phone)" class="hover:underline text-red-500 uppercase">Remove</span>
                    </td>
                </tr>  
            </input-array-component-template>

            <span v-else class="text-lg text-red-500">The user does not have phone added.</span>
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
        getPhoneTitle() {
            return this.showPhone ? 'Clear Phones' : 'Show Phones';
        },
    },
    watch: {
        showPhone(oldVal, newVal) {
            if((oldVal == false && newVal == true) && !this.$route.params.id) {
                this.tempPhone = {
                    area: '',
                    phone: '',
                };

                this.$emit('update-phone', []);
            }
        },
    },
    props: {
        phones: {
            type: Array,
            required: true,
            default: () => []
        }
    },
    data() {
        return {
            showPhone: false,
            phoneHeaders: [
                "Index",
                "Phone",
                "Delete"
            ],
            tempPhone: {
                area: '',
                phone: '',
            },
        }
    },
    methods: {
        addPhone() {
            if(this.tempPhone.area !== '' && this.tempPhone.phone !== '') {
                const newPhone = {
                    area: this.tempPhone.area,
                    phone: this.tempPhone.phone,
                };

                const newPhones = [...this.phones, newPhone];

                this.tempPhone = {
                    area: '',
                    phone: '',
                };

                this.$emit('update-phone', newPhones);
            }
        },

        removePhone(object) {
            const newPhones = this.phones.filter(el => el.phone !== object.phone);
            
            this.$emit('update-phone', newPhones);
        },
    }
}
</script>
