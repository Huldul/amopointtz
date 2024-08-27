
    async function sendVisitData() {
        try {
            const ipResponse = await fetch('https://api.ipify.org?format=json');
            const { ip } = await ipResponse.json();

            const geoResponse = await fetch(`https://ipapi.co/${ip}/json/`);
            const geoData = await geoResponse.json();

            const deviceType = /Mobi|Android/i.test(navigator.userAgent) ? 'Mobile' : 'Desktop';

            const visitData = {
                ip: ip,
                city: geoData.city || 'Unknown',
                device: deviceType,
                timestamp: new Date().toISOString(),
            };

            const response = await fetch('https://site2.limestone.kz/api/track-visit', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(visitData),
            });

            if (!response.ok) {
                throw new Error('Ответ не ok');
            }

            const result = await response.json();
            console.log(result.message);
        } catch (error) {
            console.error('Ошибка:', error);
        }
    }

    sendVisitData();

