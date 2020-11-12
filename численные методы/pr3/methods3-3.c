#include <stdio.h>
#include <stdlib.h>
#include <math.h>

float f (float x) { //функция
        return 5 * (x * x) + x + 1;
}

int main() {
    float x, s, h, S; 
    int a, b, n, i;
    S = 0;      //s - площадь
    h = 0.001;  //h - точность (шаг)
    a = -3;     //a
    b = 0;      //b
    //n = 5000;   //количество точек
    n = 100000;
    for (i = 0; i < n; i++) {
        s += f( (float) rand() / RAND_MAX * (b - a) + a) * (fabs (b - a));
    }
    S = s/n;
    printf ("OTBET: %.4f", S);
    return 0;
}
