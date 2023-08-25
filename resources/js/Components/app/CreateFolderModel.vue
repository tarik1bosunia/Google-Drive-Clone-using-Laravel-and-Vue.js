

<template>
    <modal :show="modelValue" @show="onShow" max-width="sm">
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900">
                Create New Folder
            </h2>
            <div class="mt-6">
                <InputLabel for="folderName" value="Folder Name" class="sr-only"/>
                <TextInput
                    ref="folderNameInput"
                    type="text"
                    id="folderName"
                    v-model="form.name"
                    class="mt-1 block w-full"
                    :class="form.errors.name ? 'border-red-500 focus:border-red-500 focus:ring-red-500': ''"
                    placeholder="Folder Name"
                    @keyup.enter="createFolder"
                />
                <InputError :message="form.errors.name" class="mt-2"/>
            </div>
            <div class="mt-6 flex justify-end">
                <SecondaryButton @click="closeModel">Cancel</SecondaryButton>
                <PrimaryButton
                    class="ml-3"
                    :class="{ 'opacity-25': form.processing }"
                    @click="createFolder"
                    :disable="form.processing">
                     Create
                </PrimaryButton>
            </div>
        </div>
    </modal>

</template>


<script setup>
// Imports
import Modal from "@/Components/Modal.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import {useForm} from "@inertiajs/vue3";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {nextTick, ref} from "vue";

// Uses
const form = useForm({
    name : ''
})

// Refs
const folderNameInput = ref(null)


// Props & Emit
const {modelValue} = defineProps({
    modelValue: Boolean,

})

const emit = defineEmits([
    'update:modelValue'
])

// methods
function onShow() {
    nextTick(()=> folderNameInput.value.focus())
}
function createFolder(){
    form.post(route('folder.create', {
        preserveScroll: true,
        onSuccess: ()=>{
            closeModel()
            form.reset()
            // show success notification
        },
        onError: ()=> folderNameInput.value.focus()

    }))
}

function closeModel(){
    emit('update:modelValue')
    form.clearErrors()
    form.reset()

}

</script>
