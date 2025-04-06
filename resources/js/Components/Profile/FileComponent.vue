<script setup>
import { usePage } from "@inertiajs/vue3";
import axios from "axios";
import { Button } from "primevue";
import { ref } from "vue";

const props = defineProps({
    file: String,
    user: Object,
    type: String,
});

const file = ref(props.file);

const downloadFile = async () => {
    try {
        const response = await axios.get(
            `/download/${props.user.id}/${props.type}/${file.value}`,
            {
                responseType: "blob",
            }
        );
        const url = window.URL.createObjectURL(new Blob([response.data]));
        const link = document.createElement("a");
        link.href = url;
        link.setAttribute("download", file.value); // Set the file name for download
        document.body.appendChild(link);
        link.click();
    } catch (error) {
        console.error("Error downloading file:", error);
    }
};
</script>

<template>
    <div class="space-y-6">
        <div
            class="bg-[#f8fafc] rounded-lg p-5 flex justify-between items-center"
        >
            <div class="flex gap-x-2 items-center">
                <i
                    class="pi pi-file border bg-blue-50 p-2 rounded-lg text-blue-500"
                    style="font-size: 1.7rem"
                ></i>
                <div>
                    <p>{{ file || "No supported document" }}</p>
                </div>
            </div>
            <div class="flex gap-x-6">
                <a href="">
                    <i class="pi pi-eye"></i>
                </a>
                <a href="#">
                    <i class="pi pi-download" @click="downloadFile"></i>
                </a>
                <a href="">
                    <i class="pi pi-trash"></i>
                </a>
            </div>
        </div>
        <div class="flex justify-end">
            <Button>
                <i class="pi pi-upload"></i>
                Upload new resume
            </Button>
        </div>
    </div>
</template>
