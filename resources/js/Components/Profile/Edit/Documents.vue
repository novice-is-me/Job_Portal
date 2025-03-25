<script setup>
import { Button, FileUpload } from "primevue";
import { ref } from "vue";

// File name to display in the UI
const fileName = ref("");
// File object to store the selected file
const fileObject = ref(null);

const onFileSelect = (e) => {
    const file = e.files[0];
    fileName.value = e.files[0].name;
    fileObject.value = file;
};

const deleteFile = () => {
    fileName.value = "";
    fileObject.value = null;
};

const downloadFile = () => {
    if (!fileObject.value) return; // Ensure a file is selected

    const blob = new Blob([fileObject.value], { type: fileObject.value.type });
    const link = document.createElement("a");
    link.href = URL.createObjectURL(blob);
    link.download = fileName.value;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
};
</script>

<template>
    <div class="bg-white rounded-lg p-5 space-y-4">
        <div class="space-y-6">
            <div>
                <h1 class="font-[Poppins] font-semibold text-2xl">Documents</h1>
                <p class="text-sm text-secondary">
                    Upload your resume, cover letters, and portfolio documents
                </p>
            </div>
        </div>
        <div>
            <div
                v-if="fileName"
                class="border border-gray-200 rounded-md flex flex-wrap gap-x-2"
            >
                <div
                    class="bg-gray-100 p-3 rounded-lg text-sm flex gap-x-2 items-center justify-between w-full"
                >
                    <div class="flex gap-x-2 items-center">
                        <i
                            class="pi pi-file text-blue-400 bg-blue-100 rounded-md p-2"
                            style="font-size: 1.5rem"
                        ></i>
                        <div>
                            <p class="font-[Poppins] font-semibold text-lg">
                                {{ fileName }}
                            </p>
                            <p class="text-secondary">
                                Uploaded on May 15, 2023 • 2.4 MB
                            </p>
                        </div>
                    </div>
                    <div class="flex gap-x-4 items-center">
                        <i class="pi pi-upload" @click="downloadFile"></i>
                        <i
                            class="pi pi-trash text-red-500"
                            @click="deleteFile"
                        ></i>
                    </div>
                </div>
            </div>
            <div class="flex mt-4">
                <FileUpload
                    ref="fileupload"
                    mode="basic"
                    name="demo[]"
                    :maxFileSize="1000000"
                    @select="onFileSelect"
                    :customUpload="true"
                >
                    <template #filelabel>
                        <span></span>
                    </template>
                </FileUpload>
            </div>
        </div>
        <div class="flex gap-x-4 justify-end">
            <Button>Cancel</Button>
            <Button>Save</Button>
        </div>
    </div>
</template>

<style scoped>
:deep(.p-fileupload-file-name),
:deep(.p-fileupload-content),
:deep(.p-fileupload-file-list),
:deep(.p-fileupload-file),
:deep(.p-fileupload-file-info) {
    display: none !important;
}
</style>
