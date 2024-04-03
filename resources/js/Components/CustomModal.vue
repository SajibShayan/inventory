<script setup>

import { ref } from 'vue'
import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
} from '@headlessui/vue'

defineProps({
    open: Boolean,
    title: String,
})

const isOpen = ref(false)

function closeModal() {
    isOpen.value = false
}
function openModal() {
    isOpen.value = true
}
</script>

<template>
    <div>
        <div class="relative inset-0 flex items-center justify-end">
            <slot name="btn"></slot>
            <slot name="tabs"></slot>
        </div>
        <TransitionRoot appear :show="open" as="template">
            <Dialog as="div" @close="closeModal" class="relative z-10">
                <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0"
                    enter-to="opacity-100" leave="duration-200 ease-in" leave-from="opacity-100" leave-to="opacity-0">
                    <div class="fixed inset-0 bg-black bg-opacity-80" />
                </TransitionChild>

                <div class="fixed inset-0 overflow-y-auto">
                    <div class="flex min-h-full items-center justify-center p-4 text-center">
                        <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0 scale-95"
                            enter-to="opacity-100 scale-100" leave="duration-200 ease-in"
                            leave-from="opacity-100 scale-100" leave-to="opacity-0 scale-95">
                            <slot name="main">
                            <DialogPanel
                                class="w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all">
                               <slot name="title">
                                <DialogTitle as="h3" class="text-lg font-medium leading-6 text-gray-900 mb-3">
                                    {{ title }}
                                </DialogTitle>
                               </slot>
                                <slot name="body"></slot>     
                            </DialogPanel>
                        </slot>
                        </TransitionChild>
                    </div>
                </div>
            </Dialog>
            
        </TransitionRoot>


    </div>
</template>