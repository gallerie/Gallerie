<?php
namespace Devi\Model\Storage;

use Devi\Model\StorageInterface;
use League\Flysystem\Filesystem;

class Flysystem implements StorageInterface
{
  // Variables
  private $filesystem;
  private $format;
  
  // Constructor
  public function __construct(Filesystem $filesystem, string $format = '%s')
  {
    $this->filesystem = $filesystem;
    $this->format = $format;
  }
  
  // Read the contents of a blob
  public function read($index)
  {
    $path = sprintf($this->format,$index);
    
    // Read the blob from the filesystem
    return $this->filesystem->read($path);
  }
  
  // Read the contents of a blob  as a stream
  public function readStream($index)
  {
    $path = sprintf($this->format,$index);
    
    // Read the blob from the filesystem
    return $this->filesystem->readStream($path);
  }

  // Write a string to a blob
  public function write($index, $contents)
  {
    $path = sprintf($this->format,$index);
    
    // Put the blob in the filesystem
    $this->filesystem->put($path,$contents);
  }
  
  // Write a stream to a blob
  public function writeStream($index, $stream)
  {
    $path = sprintf($this->format,$index);
    
    // Validate the stream
    if (!is_resource($stream))
      throw new Exception("The stream is not a resource");
    
    // Put the blob in the filesystem
    $this->filesystem->putStream($path,$stream);
  }
  
  // Delete a blob
  public function delete($index)
  {
    $path = sprintf($this->format,$index);
    
    // Delete the blob from the filesystem
    $this->filesystem->delete($path);
  }
}