<script setup>
import { Button, FileUpload } from "primevue";
import { ref } from "vue";

// File name to display in the UI
const resume = ref("");
const coverLetter = ref("");
// File object to store the selected file
const fileObjectResume = ref(null);
const fileObjectCoverLetter = ref(null);

const selectResume = (e) => {
    const file = e.files[0];
    resume.value = e.files[0].name;
    fileObjectResume.value = file;
};

const selectCoverLetter = (e) => {
    const file = e.files[0];
    coverLetter.value = e.files[0].name;
    fileObjectCoverLetter.value = file;
};

const deleteFile = (data) => {
    if (data === "resume") {
        resume.value = "";
        fileObjectResume.value = null;
    } else if (data === "coverLetter") {
        coverLetter.value = "";
        fileObjectCoverLetter.value = null;
    }
};

const downloadFile = (data) => {
    let fileObject;
    let fileName;

    if (data === "resume") {
        fileObject = fileObjectResume.value;
        fileName = resume.value;
    } else if (data === "coverLetter") {
        fileObject = fileObjectCoverLetter.value; // Assuming you have a coverLetter file object
        fileName = coverLetter.value; // Assuming you have a coverLetter name
    }

    if (!fileObject) return; // Ensure a file is selected

    const blob = new Blob([fileObject], {
        type: fileObject.type,
    });
    const link = document.createElement("a");
    link.href = URL.createObjectURL(blob);
    link.download = fileName;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
};

const save = () => {
    console.log("Saving files...");
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
        <div class="space-y-6">
            <div v-if="resume" class="rounded-md flex flex-wrap gap-2">
                <p class="font-[Poppins] text-xl font-medium">Resume</p>
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
                                {{ resume }}
                            </p>
                            <p class="text-secondary">
                                Uploaded on May 15, 2023 • 2.4 MB
                            </p>
                        </div>
                    </div>
                    <div class="flex gap-x-4 items-center">
                        <i
                            class="pi pi-upload"
                            @click="downloadFile('resume')"
                        ></i>
                        <i
                            class="pi pi-trash text-red-500"
                            @click="deleteFile('resume')"
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
                    @select="selectResume"
                    :customUpload="true"
                    chooseLabel="Resume"
                >
                    <template #filelabel>
                        <span></span>
                    </template>
                </FileUpload>
            </div>

            <!-- For cover letter -->
            <div v-if="coverLetter" class="rounded-md flex flex-wrap gap-2">
                <p class="font-[Poppins] text-xl font-medium">Cover Letter</p>
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
                                {{ coverLetter }}
                            </p>
                            <p class="text-secondary">
                                Uploaded on May 15, 2023 • 2.4 MB
                            </p>
                        </div>
                    </div>
                    <div class="flex gap-x-4 items-center">
                        <i
                            class="pi pi-upload"
                            @click="downloadFile('coverLetter')"
                        ></i>
                        <i
                            class="pi pi-trash text-red-500"
                            @click="deleteFile('coverLetter')"
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
                    @select="selectCoverLetter"
                    :customUpload="true"
                    chooseLabel="Cover Letter"
                >
                    <template #filelabel>
                        <span></span>
                    </template>
                </FileUpload>
            </div>
        </div>
        <div class="flex gap-x-4 justify-end">
            <Button>Cancel</Button>
            <Button @click="save">Save</Button>
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
