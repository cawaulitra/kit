#include <stdio.h>
#include <math.h>

float f(float x)
{
	return (x * x * x) + 2 * (x * x) - 8 * x + 3;
}

int main()
{
        float eps, x, c, delta;

        eps = 0.001;
        delta = eps + eps;

        printf("x, c: ");
        scanf("%f %f", &x, &c);

        while(1)
        {
            if( (x + delta) >= c){
                printf("No root \n");
                break;
            }
            if( (f(x) * f(x + delta)) > 0) x += delta;
            else
                {
                printf("OTBET: %f \n", (x + eps));
                break;
                }
        }

	return 0;
}
