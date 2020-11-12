#include <stdio.h>
#include <stdlib.h>
#include <math.h>

float f (float x) { //функция
        return 5 * (x * x) + x + 1;
}

int main() {
    float x, s, h;
    int a, b;
    s = 0;      //s - площадь
    h = 0.001;  //h - точность (шаг)
    a = -3;     //a
    b = 0;      //b
    for (x = a; x < b; x += h) {
        s = (f(a) + f(b)/2);
        for (x = a + b; x < b; x+=h) {
            s += f(x);
        }
    }
    s *= h;
    printf ("OTBET: %f", s);
    return 0;
}