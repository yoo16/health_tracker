// データ取得関数（共通）
async function fetchHealthData() {
    const response = await fetch('api/health.php');
    if (!response.ok) throw new Error('データ取得エラー');
    return await response.json();
}

// 体重グラフ
function renderWeightChart(data) {
    const labels = data.map(item => item.recorded_at);
    const weights = data.map(item => parseFloat(item.weight));

    const minWeight = Math.min(...weights);
    const maxWeight = Math.max(...weights);

    new Chart(document.getElementById('weightChart').getContext('2d'), {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: '体重 (kg)',
                data: weights,
                borderColor: 'rgb(43, 103, 135)',
                borderWidth: 2,
                fill: false,
                tension: 0.3,
            }]
        },
        options: {
            responsive: true,
            plugins: { title: { display: true, text: '体重の推移' } },
            scales: { y: { beginAtZero: false } },
            scales: {
                y: {
                    beginAtZero: false,
                    min: Math.floor(minWeight - 1), // 下に1kg余白
                    max: Math.ceil(maxWeight + 1), // 上に1kg余白
                    title: {
                        display: true,
                        text: 'kg'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: '記録日'
                    }
                }
            }
        }
    });
}

// 心拍数グラフ
Chart.register(window['chartjs-plugin-annotation']); // プラグインの登録（必要）

function renderHeartRateChart(data) {
    const labels = data.map(item => item.recorded_at);
    const heartRates = data.map(item => parseInt(item.heart_rate));

    new Chart(document.getElementById('heartRateChart').getContext('2d'), {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: '心拍数 (bpm)',
                data: heartRates,
                borderColor: 'rgba(220, 38, 38, 1)',
                borderWidth: 2,
                fill: false,
                tension: 0.3,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: { display: true, text: '心拍数の推移' },
                annotation: {
                    annotations: {
                        line60: {
                            type: 'line',
                            yMin: 60,
                            yMax: 60,
                            borderColor: 'blue',
                            borderWidth: 1,
                            borderDash: [6, 4], // 👈 点線指定
                            label: {
                                enabled: true,
                                position: 'end',
                                backgroundColor: 'transparent',
                            }
                        },
                        line100: {
                            type: 'line',
                            yMin: 100,
                            yMax: 100,
                            borderColor: 'red',
                            borderWidth: 1,
                            borderDash: [6, 4], // 👈 点線指定
                            label: {
                                enabled: true,
                                position: 'end',
                                backgroundColor: 'transparent',
                            }
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: false,
                    min: 40,
                    max: 120,
                    ticks: {
                        stepSize: 5,
                    },
                    title: {
                        display: true,
                        text: 'bpm'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: '記録日'
                    }
                }
            }
        }
    });
}


// 血圧グラフ
Chart.register(window['chartjs-plugin-annotation']);

function renderBloodPressureChart(data) {
    const labels = data.map(item => item.recorded_at);
    const bpRanges = data.map(item => ({
        x: item.recorded_at,
        y: [parseInt(item.diastolic), parseInt(item.systolic)]
    }));

    new Chart(document.getElementById('bpChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: '血圧範囲 (mmHg)',
                data: bpRanges,
                backgroundColor: 'rgba(33, 130, 51, 0.6)',
                borderColor: 'rgba(21, 79, 31, 0.6)',
                borderWidth: 1,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: '血圧の推移（拡張期〜収縮期）'
                },
                tooltip: {
                    callbacks: {
                        label: (ctx) => {
                            const [low, high] = ctx.raw.y;
                            return `拡張期 ${low} mmHg - 収縮期 ${high} mmHg`;
                        }
                    }
                },
                annotation: {
                    annotations: {
                        hypertensionZone: {
                            type: 'box',
                            yMin: 140,
                            yMax: 200,
                            backgroundColor: 'rgba(255, 99, 132, 0.15)',
                            borderWidth: 0,
                            label: {
                                content: '高血圧域',
                                enabled: true,
                                position: 'start'
                            }
                        },
                        lowBloodPressureZone: {
                            type: 'box',
                            yMin: 0,
                            yMax: 90,
                            backgroundColor: 'rgba(99, 149, 255, 0.15)',
                            borderWidth: 0,
                            label: {
                                content: '低血圧域',
                                enabled: true,
                                position: 'end'
                            }
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: false,
                    max: 200,
                    min: 0,
                    ticks: {
                        stepSize: 25
                    },
                    title: {
                        display: true,
                        text: 'mmHg'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: '記録日'
                    }
                }
            }
        }
    });
}

// 実行エントリーポイント
async function renderCharts() {
    try {
        const data = await fetchHealthData();
        renderWeightChart(data);
        renderHeartRateChart(data);
        renderBloodPressureChart(data);
    } catch (error) {
        console.error('エラー:', error);
    }
}

function downloadChart() {
    const canvasIds = ['weightChart', 'heartRateChart', 'bpChart'];
    const canvases = canvasIds.map(id => document.getElementById(id));
    
    const width = Math.max(...canvases.map(c => c.width));
    const height = canvases.reduce((sum, c) => sum + c.height, 0);

    const combinedCanvas = document.createElement('canvas');
    combinedCanvas.width = width;
    combinedCanvas.height = height;
    const ctx = combinedCanvas.getContext('2d');
    ctx.fillStyle = 'white';
    ctx.fillRect(0, 0, width, height);

    let y = 0;
    canvases.forEach(canvas => {
        ctx.drawImage(canvas, 0, y);
        y += canvas.height;
    });

    const link = document.createElement('a');
    link.href = combinedCanvas.toDataURL('image/png');
    link.download = 'health_chart.png';
    link.click();
}


// 起動
renderCharts();