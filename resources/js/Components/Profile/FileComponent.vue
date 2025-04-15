<script setup>
import { usePage } from "@inertiajs/vue3";
import { data } from "autoprefixer";
import axios from "axios";
import { Button, FileUpload } from "primevue";
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

const deleteFile = async () => {
    try {
        const response = await axios.delete(
            `/profile/delete/documents/${props.user.id}`,
            {
                data: {
                    type: props.type,
                    file: file.value,
                },
            }
        );

        file.value = null; // Clear the file reference after deletion

        console.log("File deleted successfully:", response.data);
    } catch (error) {
        console.error("Error deleting file:", error);
    }
};

const selectFile = async (e, type) => {
    file.value = e.files[0].name; // Update the file name in the UI

    try {
        const formData = new FormData();

        // Append actual files to FormData
        if (type === "resume") {
            formData.append("resume", e.files[0]);
        }
        if (type === "cover_letter") {
            formData.append("coverLetter", e.files[0]);
        }

        const response = await axios.post("/profile/edit/documents", formData, {
            headers: {
                "Content-Type": "multipart/form-data",
            },
        });

        console.log("Files saved successfully:", response.data);
    } catch (error) {
        console.error("Error saving files:", error);
    }
};
</script>

<template>
    <div class="space-y-6">
        <div
            v-if="file"
            class="bg-[#f8fafc] rounded-lg p-5 flex justify-between items-center"
        >
            <div class="flex gap-x-2 items-center">
                <i
                    class="pi pi-file border bg-blue-50 p-2 rounded-lg text-blue-500"
                    style="font-size: 1.7rem"
                ></i>
                <div>
                    <p>{{ file }}</p>
                </div>
            </div>
            <div class="flex gap-x-6">
                <a href="#">
                    <i class="pi pi-eye"></i>
                </a>
                <a href="#">
                    <i class="pi pi-download" @click="downloadFile"></i>
                </a>
                <a href="#">
                    <i class="pi pi-trash" @click="deleteFile"></i>
                </a>
            </div>
        </div>
        <div class="flex justify-end">
            <div class="flex mt-4">
                <FileUpload
                    ref="fileupload"
                    mode="basic"
                    name="demo[]"
                    :maxFileSize="1000000"
                    @select="(e) => selectFile(e, props.type)"
                    :customUpload="true"
                    chooseLabel="Upload"
                >
                    <template #filelabel>
                        <span></span>
                    </template>
                </FileUpload>
            </div>
        </div>
    </div>
</template>
