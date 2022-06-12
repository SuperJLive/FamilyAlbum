<?php
namespace App\Media;

class ChunkUpload {
    private string $ileId; //文件ID，格式：文件大小_文件名
    private string $fileName; //文件名
    private string $fileRelativePath; //文件路径
    private long $chunkIndex; //分片编号
    private long $fileSize; //文件大小
    private long $chunkSize; //分片大小
    private long $chunkSizeStart; //分片偏移字节数
    private long $chunkCount; //总分片数
    private long $retryCount; //重试次数
    //private MultipartFile fileBlob; //分片内容
}
