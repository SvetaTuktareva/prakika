function createImageParts() {
           const container = document.querySelector('.image-parts');
           const finalImage = document.querySelector('.final-image');
           const rows = 8;
           const cols = 8;
           
           finalImage.onload = () => {
               const partWidth = finalImage.width / cols;
               const partHeight = finalImage.height / rows;
               
               for (let i = 0; i < rows; i++) {
                   for (let j = 0; j < cols; j++) {
                       const part = document.createElement('div');
                       part.className = 'image-part';
                       
                       part.style.width = `${partWidth}px`;
                       part.style.height = `${partHeight}px`;
                       part.style.backgroundImage = `url(${finalImage.src})`;
                       part.style.backgroundPosition = `-${j * partWidth}px -${i * partHeight}px`;
                       part.style.backgroundSize = `${finalImage.width}px ${finalImage.height}px`;
                       
                       const startX = (Math.random() - 0.5) * 1000;
                       const startY = (Math.random() - 0.5) * 1000;
                       const endX = j * partWidth;
                       const endY = i * partHeight;
                       
                       part.style.setProperty('--start-x', `${startX}px`);
                       part.style.setProperty('--start-y', `${startY}px`);
                       part.style.setProperty('--end-x', `${endX}px`);
                       part.style.setProperty('--end-y', `${endY}px`);
                       
                       part.style.animationDelay = `${(i * cols + j) * 0.05}s`;
                       
                       container.appendChild(part);
                   }
               }
           };
       }
        createImageParts();